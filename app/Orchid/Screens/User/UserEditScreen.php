<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User;

use App\Models\User;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserEditScreen extends Screen
{
    /**
     * @var User
     */
    public $user;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(User $user): iterable
    {
        return [
            'user' => $user,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Editar usuário';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Atualize os dados e o perfil de acesso.';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Salvar')
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(UserEditLayout::class)
                ->title('Dados do usuário')
                ->description('Nome, telefone, perfil e situação da conta.'),
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function save(User $user, Request $request)
    {
        $validated = $request->validate([
            'user.name' => ['required', 'string', 'max:255'],
            'user.phone' => ['nullable', 'string', 'max:255'],
            'user.role' => ['required', 'in:admin,resident,partner'],
            'user.active' => ['required', 'boolean'],
        ]);

        $user->update($validated['user']);

        Toast::info('Usuário atualizado.');

        return redirect()->route('platform.systems.users');
    }
}
