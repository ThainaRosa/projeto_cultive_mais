<?php

declare(strict_types=1);

namespace App\Orchid\Screens\WasteRecord;

use App\Models\WasteRecord;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class WasteRecordListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'wasteRecords' => WasteRecord::query()->with(['user', 'wasteCategory'])->latest()->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Resíduos';
    }

    public function permission(): ?iterable
    {
        return ['platform.waste-records'];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('wasteRecords', [
                TD::make('id', 'ID'),
                TD::make('user.name', 'Morador')->render(fn (WasteRecord $record) => $record->user->name),
                TD::make('waste_category_id', 'Categoria')->render(fn (WasteRecord $record) => $record->wasteCategory->name),
                TD::make('quantity', 'Quantidade')->render(fn (WasteRecord $record) => $record->quantity.' '.$record->unit),
                TD::make('status', 'Status'),
                TD::make('Ações')->render(fn (WasteRecord $record) => Link::make('Visualizar')
                    ->icon('bs.eye')
                    ->route('platform.waste-records.show', $record)),
            ]),
        ];
    }
}
