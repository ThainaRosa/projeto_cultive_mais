<?php

declare(strict_types=1);

namespace App\Orchid\Screens\WasteCategory;

use App\Models\WasteCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class WasteCategoryEditScreen extends Screen
{
    public $category;

    public function query(WasteCategory $category): iterable
    {
        $this->category = $category;

        if (! $category->exists) {
            $category->active = true;
        }

        return ['category' => $category];
    }

    public function name(): ?string
    {
        return $this->category->exists ? 'Editar categoria' : 'Criar categoria';
    }

    public function permission(): ?iterable
    {
        return ['platform.categories'];
    }

    /** @return Action[] */
    public function commandBar(): iterable
    {
        return [
            Button::make('Salvar')->icon('bs.check-circle')->method('save'),
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('category.name')->title('Nome')->required()->maxlength(255),
                TextArea::make('category.description')->title('Descrição')->rows(4),
                Switcher::make('category.active')->title('Categoria ativa')->sendTrueOrFalse(),
            ]),
        ];
    }

    public function save(WasteCategory $category, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category.name' => ['required', 'string', 'max:255'],
            'category.description' => ['nullable', 'string'],
            'category.active' => ['required', 'boolean'],
        ]);

        $category->fill($validated['category'])->save();

        Toast::info('Categoria salva.');

        return redirect()->route('platform.categories');
    }
}
