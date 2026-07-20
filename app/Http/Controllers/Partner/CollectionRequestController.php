<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\CollectionRequest;
use App\Models\WasteRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CollectionRequestController extends Controller
{
    public function pending(): View
    {
        return view('partner.collection-requests.pending', [
            'collectionRequests' => CollectionRequest::query()
                ->where('status', CollectionRequest::STATUS_PENDING)
                ->with(['wasteRecord.wasteCategory', 'resident'])
                ->oldest()
                ->paginate(10),
        ]);
    }

    public function accepted(Request $request): View
    {
        return view('partner.collection-requests.accepted', [
            'collectionRequests' => $request->user()
                ->partnerCollectionRequests()
                ->where('status', CollectionRequest::STATUS_ACCEPTED)
                ->with(['wasteRecord.wasteCategory', 'resident', 'collectionPoint'])
                ->orderBy('scheduled_date')
                ->paginate(10),
        ]);
    }

    public function show(Request $request, CollectionRequest $collectionRequest): View
    {
        $this->ensureVisibleToPartner($request, $collectionRequest);

        return view('partner.collection-requests.show', [
            'collectionRequest' => $collectionRequest->load(['wasteRecord.wasteCategory', 'resident', 'collectionPoint']),
        ]);
    }

    public function accept(Request $request, CollectionRequest $collectionRequest): RedirectResponse
    {
        $validated = $request->validate([
            'scheduled_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        DB::transaction(function () use ($request, $collectionRequest, $validated) {
            $lockedRequest = CollectionRequest::query()->lockForUpdate()->findOrFail($collectionRequest->id);

            abort_unless(
                $lockedRequest->status === CollectionRequest::STATUS_PENDING && $lockedRequest->partner_id === null,
                422,
                'Esta solicitação não está mais disponível.',
            );

            $lockedRequest->update([
                'partner_id' => $request->user()->id,
                'scheduled_date' => $validated['scheduled_date'],
                'status' => CollectionRequest::STATUS_ACCEPTED,
            ]);
        });

        return redirect()
            ->route('partner.collection-requests.show', $collectionRequest)
            ->with('success', 'Solicitação aceita e coleta agendada.');
    }

    public function complete(Request $request, CollectionRequest $collectionRequest): RedirectResponse
    {
        $this->ensureOwnedAcceptedRequest($request, $collectionRequest);

        DB::transaction(function () use ($collectionRequest) {
            $collectionRequest->update(['status' => CollectionRequest::STATUS_COMPLETED]);
            $collectionRequest->wasteRecord->update(['status' => WasteRecord::STATUS_COLLECTED]);
        });

        return redirect()
            ->route('partner.collection-requests.show', $collectionRequest)
            ->with('success', 'Coleta marcada como concluída.');
    }

    public function cancel(Request $request, CollectionRequest $collectionRequest): RedirectResponse
    {
        $this->ensureOwnedAcceptedRequest($request, $collectionRequest);

        DB::transaction(function () use ($collectionRequest) {
            $collectionRequest->update(['status' => CollectionRequest::STATUS_CANCELLED]);

            if ($collectionRequest->wasteRecord->status === WasteRecord::STATUS_REQUESTED) {
                $collectionRequest->wasteRecord->update(['status' => WasteRecord::STATUS_AVAILABLE]);
            }
        });

        return redirect()
            ->route('partner.collection-requests.show', $collectionRequest)
            ->with('success', 'Solicitação cancelada e resíduo disponibilizado novamente.');
    }

    private function ensureVisibleToPartner(Request $request, CollectionRequest $collectionRequest): void
    {
        if ($collectionRequest->status === CollectionRequest::STATUS_PENDING) {
            return;
        }

        abort_unless($collectionRequest->partner_id === $request->user()->id, 404);
    }

    private function ensureOwnedAcceptedRequest(Request $request, CollectionRequest $collectionRequest): void
    {
        abort_unless(
            $collectionRequest->partner_id === $request->user()->id
                && $collectionRequest->status === CollectionRequest::STATUS_ACCEPTED,
            404,
        );
    }
}
