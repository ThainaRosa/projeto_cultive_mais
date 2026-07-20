<?php

declare(strict_types=1);

namespace App\Orchid\Screens\CollectionPoint;

use App\Models\CollectionPoint;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CollectionPointListScreen extends Screen
{
    public function query(): iterable
    {
        return ['collectionPoints' => CollectionPoint::query()->orderBy('name')->paginate()];
    }

    public function name(): ?string
    {
        return 'Pontos de coleta';
    }

    public function permission(): ?iterable
    {
        return ['platform.collection-points'];
    }

    /** @return Action[] */
    public function commandBar(): iterable
    {
        return [
            Link::make('Criar ponto de coleta')
                ->icon('bs.plus-circle')
                ->route('platform.collection-points.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('collectionPoints', [
                TD::make('name', 'Nome')
                    ->render(fn (CollectionPoint $point) => Link::make($point->name)
                        ->route('platform.collection-points.edit', $point)),
                TD::make('neighborhood', 'Bairro'),
                TD::make('city', 'Cidade'),
                TD::make('active', 'Status')->render(fn (CollectionPoint $point) => $point->active ? 'Ativo' : 'Inativo'),
                TD::make('Ações')->align(TD::ALIGN_CENTER)
                    ->render(fn (CollectionPoint $point) => Button::make('Excluir')
                        ->icon('bs.trash3')
                        ->confirm('Deseja excluir este ponto de coleta?')
                        ->method('remove', ['id' => $point->id])),
            ]),
        ];
    }

    public function remove(Request $request): void
    {
        $point = CollectionPoint::query()->findOrFail($request->integer('id'));

        if ($point->collectionRequests()->exists()) {
            Toast::warning('Este ponto possui solicitações vinculadas e não pode ser excluído.');

            return;
        }

        $point->delete();
        Toast::info('Ponto de coleta excluído.');
    }
}
