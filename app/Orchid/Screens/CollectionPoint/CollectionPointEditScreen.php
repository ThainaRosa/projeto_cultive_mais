<?php

declare(strict_types=1);

namespace App\Orchid\Screens\CollectionPoint;

use App\Models\CollectionPoint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CollectionPointEditScreen extends Screen
{
    public $collectionPoint;

    public function query(CollectionPoint $collectionPoint): iterable
    {
        $this->collectionPoint = $collectionPoint;

        if (! $collectionPoint->exists) {
            $collectionPoint->active = true;
            $collectionPoint->state = 'SP';
        }

        return ['collectionPoint' => $collectionPoint];
    }

    public function name(): ?string
    {
        return $this->collectionPoint->exists ? 'Editar ponto de coleta' : 'Criar ponto de coleta';
    }

    public function permission(): ?iterable
    {
        return ['platform.collection-points'];
    }

    /** @return Action[] */
    public function commandBar(): iterable
    {
        return [Button::make('Salvar')->icon('bs.check-circle')->method('save')];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('collectionPoint.name')->title('Nome')->required()->maxlength(255),
                Input::make('collectionPoint.address')->title('Endereço')->required()->maxlength(255),
                Input::make('collectionPoint.neighborhood')->title('Bairro')->required()->maxlength(255),
                Input::make('collectionPoint.city')->title('Cidade')->required()->maxlength(255),
                Input::make('collectionPoint.state')->title('Estado')->required()->maxlength(2),
                Input::make('collectionPoint.latitude')->type('number')->step('0.0000001')->title('Latitude'),
                Input::make('collectionPoint.longitude')->type('number')->step('0.0000001')->title('Longitude'),
                Input::make('collectionPoint.opening_hours')->title('Horário de funcionamento')->maxlength(255),
                Input::make('collectionPoint.phone')->title('Telefone')->maxlength(255),
                Switcher::make('collectionPoint.active')->title('Ponto ativo')->sendTrueOrFalse(),
            ]),
        ];
    }

    public function save(CollectionPoint $collectionPoint, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'collectionPoint.name' => ['required', 'string', 'max:255'],
            'collectionPoint.address' => ['required', 'string', 'max:255'],
            'collectionPoint.neighborhood' => ['required', 'string', 'max:255'],
            'collectionPoint.city' => ['required', 'string', 'max:255'],
            'collectionPoint.state' => ['required', 'string', 'size:2'],
            'collectionPoint.latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'collectionPoint.longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'collectionPoint.opening_hours' => ['nullable', 'string', 'max:255'],
            'collectionPoint.phone' => ['nullable', 'string', 'max:255'],
            'collectionPoint.active' => ['required', 'boolean'],
        ]);

        $collectionPoint->fill($validated['collectionPoint'])->save();

        Toast::info('Ponto de coleta salvo.');

        return redirect()->route('platform.collection-points');
    }
}
