<?php

declare(strict_types=1);

namespace App\Orchid\Screens\WasteCategory;

use App\Models\WasteCategory;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class WasteCategoryListScreen extends Screen
{
    public function query(): iterable
    {
        return [
            'categories' => WasteCategory::query()->orderBy('name')->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Categorias de resíduos';
    }

    public function permission(): ?iterable
    {
        return ['platform.categories'];
    }

    /** @return Action[] */
    public function commandBar(): iterable
    {
        return [
            Link::make('Criar categoria')
                ->icon('bs.plus-circle')
                ->route('platform.categories.create'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('categories', [
                TD::make('name', 'Nome')
                    ->render(fn (WasteCategory $category) => Link::make($category->name)
                        ->route('platform.categories.edit', $category)),
                TD::make('description', 'Descrição'),
                TD::make('active', 'Status')
                    ->render(fn (WasteCategory $category) => $category->active ? 'Ativa' : 'Inativa'),
                TD::make('Ações')
                    ->align(TD::ALIGN_CENTER)
                    ->render(fn (WasteCategory $category) => Button::make($category->active ? 'Desativar' : 'Ativar')
                        ->method('toggle', ['id' => $category->id])
                        ->icon($category->active ? 'bs.pause-circle' : 'bs.play-circle')),
            ]),
        ];
    }

    public function toggle(Request $request): void
    {
        $category = WasteCategory::query()->findOrFail($request->integer('id'));
        $category->update(['active' => ! $category->active]);

        Toast::info('Status da categoria atualizado.');
    }
}
