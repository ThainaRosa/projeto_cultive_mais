<?php

declare(strict_types=1);

namespace App\Orchid\Screens\CollectionRequest;

use App\Models\CollectionRequest;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class CollectionRequestListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'collectionRequests' => CollectionRequest::query()
                ->with(['resident', 'partner', 'wasteRecord.wasteCategory'])
                ->latest()
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Solicitações de coleta';
    }

    public function permission(): ?iterable
    {
        return ['platform.collection-requests'];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('collectionRequests', [
                TD::make('id', 'ID'),
                TD::make('resident_id', 'Morador')->render(fn (CollectionRequest $request) => $request->resident->name),
                TD::make('waste_record_id', 'Resíduo')->render(fn (CollectionRequest $request) => $request->wasteRecord->wasteCategory->name),
                TD::make('partner_id', 'Parceiro')->render(fn (CollectionRequest $request) => $request->partner?->name ?? 'Não definido'),
                TD::make('status', 'Status'),
                TD::make('scheduled_date', 'Data da coleta')->render(fn (CollectionRequest $request) => $request->scheduled_date?->format('d/m/Y') ?? 'A definir'),
                TD::make('Ações')->render(fn (CollectionRequest $request) => Link::make('Visualizar')
                    ->icon('bs.eye')
                    ->route('platform.collection-requests.show', $request)),
            ]),
        ];
    }
}
