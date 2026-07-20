<?php

declare(strict_types=1);

namespace App\Orchid\Screens\WasteRecord;

use App\Models\WasteRecord;
use Orchid\Screen\Screen;
use Orchid\Screen\Sight;
use Orchid\Support\Facades\Layout;

class WasteRecordViewScreen extends Screen
{
    public $wasteRecord;

    public function query(WasteRecord $wasteRecord): iterable
    {
        $this->wasteRecord = $wasteRecord;

        return ['wasteRecord' => $wasteRecord->load(['user', 'wasteCategory'])];
    }

    public function name(): ?string
    {
        return 'Resíduo #'.$this->wasteRecord->id;
    }

    public function permission(): ?iterable
    {
        return ['platform.waste-records'];
    }

    public function layout(): iterable
    {
        return [
            Layout::legend('wasteRecord', [
                Sight::make('id', 'ID'),
                Sight::make('user', 'Morador')->render(fn (WasteRecord $record) => $record->user->name),
                Sight::make('wasteCategory', 'Categoria')->render(fn (WasteRecord $record) => $record->wasteCategory->name),
                Sight::make('description', 'Descrição'),
                Sight::make('quantity', 'Quantidade')->render(fn (WasteRecord $record) => $record->quantity.' '.$record->unit),
                Sight::make('status', 'Status'),
                Sight::make('created_at', 'Cadastrado em')->render(fn (WasteRecord $record) => $record->created_at->format('d/m/Y H:i')),
            ]),
        ];
    }
}
