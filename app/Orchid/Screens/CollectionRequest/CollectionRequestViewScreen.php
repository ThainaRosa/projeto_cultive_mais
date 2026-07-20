<?php

declare(strict_types=1);

namespace App\Orchid\Screens\CollectionRequest;

use App\Models\CollectionRequest;
use App\Models\User;
use App\Models\WasteRecord;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CollectionRequestViewScreen extends Screen
{
    public $collectionRequest;

    public function query(CollectionRequest $collectionRequest): iterable
    {
        $this->collectionRequest = $collectionRequest;

        return [
            'collectionRequest' => $collectionRequest->load(['resident', 'partner', 'wasteRecord.wasteCategory', 'collectionPoint']),
        ];
    }

    public function name(): ?string
    {
        return 'Solicitação #'.$this->collectionRequest->id;
    }

    public function permission(): ?iterable
    {
        return ['platform.collection-requests'];
    }

    /** @return Action[] */
    public function commandBar(): iterable
    {
        return [Button::make('Salvar alterações')->icon('bs.check-circle')->method('save')];
    }

    public function layout(): iterable
    {
        return [
            Layout::legend('collectionRequest', [
                Sight::make('resident', 'Morador')->render(fn (CollectionRequest $request) => $request->resident->name),
                Sight::make('wasteRecord', 'Resíduo')->render(fn (CollectionRequest $request) => $request->wasteRecord->wasteCategory->name.' — '.$request->wasteRecord->quantity.' '.$request->wasteRecord->unit),
                Sight::make('requested_date', 'Data da solicitação')->render(fn (CollectionRequest $request) => $request->requested_date?->format('d/m/Y') ?? 'Não informada'),
                Sight::make('scheduled_date', 'Data da coleta')->render(fn (CollectionRequest $request) => $request->scheduled_date?->format('d/m/Y') ?? 'A definir'),
                Sight::make('collectionPoint', 'Ponto de coleta')->render(fn (CollectionRequest $request) => $request->collectionPoint?->name ?? 'Não definido'),
                Sight::make('notes', 'Observações'),
            ]),
            Layout::rows([
                Select::make('collectionRequest.status')
                    ->options([
                        CollectionRequest::STATUS_PENDING => 'Pendente',
                        CollectionRequest::STATUS_ACCEPTED => 'Aceita',
                        CollectionRequest::STATUS_COMPLETED => 'Concluída',
                        CollectionRequest::STATUS_CANCELLED => 'Cancelada',
                    ])
                    ->required()
                    ->title('Status'),
                Select::make('collectionRequest.partner_id')
                    ->fromQuery(User::query()->where('role', User::ROLE_PARTNER)->where('active', true), 'name')
                    ->empty('Não definido')
                    ->title('Parceiro'),
            ]),
        ];
    }

    public function save(CollectionRequest $collectionRequest, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'collectionRequest.status' => ['required', 'in:pending,accepted,completed,cancelled'],
            'collectionRequest.partner_id' => ['nullable', 'exists:users,id'],
        ]);

        $data = $validated['collectionRequest'];

        if (in_array($data['status'], [CollectionRequest::STATUS_ACCEPTED, CollectionRequest::STATUS_COMPLETED], true)) {
            $request->validate(['collectionRequest.partner_id' => ['required']]);
        }

        DB::transaction(function () use ($collectionRequest, $data) {
            $collectionRequest->update($data);

            $wasteStatus = match ($data['status']) {
                CollectionRequest::STATUS_COMPLETED => WasteRecord::STATUS_COLLECTED,
                CollectionRequest::STATUS_CANCELLED => WasteRecord::STATUS_AVAILABLE,
                default => WasteRecord::STATUS_REQUESTED,
            };

            $collectionRequest->wasteRecord->update(['status' => $wasteStatus]);
        });

        Toast::info('Solicitação atualizada.');

        return redirect()->route('platform.collection-requests.show', $collectionRequest);
    }
}
