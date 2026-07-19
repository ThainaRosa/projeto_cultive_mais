<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\CollectionRequest;
use App\Models\WasteRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CollectionRequestController extends Controller
{
    public function index(Request $request): View
    {
        return view('resident.collection-requests.index', [
            'collectionRequests' => $request->user()
                ->residentCollectionRequests()
                ->with(['wasteRecord.wasteCategory', 'partner', 'collectionPoint'])
                ->latest()
                ->paginate(10),
        ]);
    }

    public function store(Request $request, WasteRecord $wasteRecord): RedirectResponse
    {
        $this->ensureWasteOwnership($request, $wasteRecord);
        abort_unless($wasteRecord->status === WasteRecord::STATUS_AVAILABLE, 422, 'Apenas resíduos disponíveis podem gerar uma solicitação.');

        $collectionRequest = DB::transaction(function () use ($request, $wasteRecord) {
            $collectionRequest = $wasteRecord->collectionRequests()->create([
                'resident_id' => $request->user()->id,
                'requested_date' => now()->toDateString(),
                'status' => CollectionRequest::STATUS_PENDING,
            ]);

            $wasteRecord->update(['status' => WasteRecord::STATUS_REQUESTED]);

            return $collectionRequest;
        });

        return redirect()
            ->route('resident.collection-requests.show', $collectionRequest)
            ->with('success', 'Solicitação de coleta criada com sucesso.');
    }

    public function show(Request $request, CollectionRequest $collectionRequest): View
    {
        $this->ensureRequestOwnership($request, $collectionRequest);

        return view('resident.collection-requests.show', [
            'collectionRequest' => $collectionRequest->load(['wasteRecord.wasteCategory', 'partner', 'collectionPoint']),
        ]);
    }

    public function cancel(Request $request, CollectionRequest $collectionRequest): RedirectResponse
    {
        $this->ensureRequestOwnership($request, $collectionRequest);
        abort_if($collectionRequest->status === CollectionRequest::STATUS_COMPLETED, 422, 'Solicitações concluídas não podem ser canceladas.');

        if ($collectionRequest->status === CollectionRequest::STATUS_CANCELLED) {
            return redirect()->route('resident.collection-requests.show', $collectionRequest);
        }

        DB::transaction(function () use ($collectionRequest) {
            $collectionRequest->update(['status' => CollectionRequest::STATUS_CANCELLED]);

            if ($collectionRequest->wasteRecord->status === WasteRecord::STATUS_REQUESTED) {
                $collectionRequest->wasteRecord->update(['status' => WasteRecord::STATUS_AVAILABLE]);
            }
        });

        return redirect()
            ->route('resident.collection-requests.show', $collectionRequest)
            ->with('success', 'Solicitação cancelada e resíduo disponibilizado novamente.');
    }

    private function ensureWasteOwnership(Request $request, WasteRecord $wasteRecord): void
    {
        abort_unless($wasteRecord->user_id === $request->user()->id, 404);
    }

    private function ensureRequestOwnership(Request $request, CollectionRequest $collectionRequest): void
    {
        abort_unless($collectionRequest->resident_id === $request->user()->id, 404);
    }
}
