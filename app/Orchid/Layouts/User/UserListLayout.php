<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class UserListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'users';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('name', 'Nome')
                ->sort()
                ->cantHide()
                ->filter(Input::make())
                ->render(fn (User $user) => new Persona($user->presenter())),

            TD::make('email', 'E-mail')
                ->sort()
                ->cantHide()
                ->filter(Input::make()),

            TD::make('phone', 'Telefone'),

            TD::make('role', 'Perfil')
                ->render(fn (User $user) => match ($user->role) {
                    User::ROLE_ADMIN => 'Administrador',
                    User::ROLE_RESIDENT => 'Morador',
                    User::ROLE_PARTNER => 'Parceiro',
                    default => $user->role,
                }),

            TD::make('active', 'Status')
                ->render(fn (User $user) => $user->active ? 'Ativo' : 'Inativo'),

            TD::make('created_at', 'Cadastro')
                ->usingComponent(DateTimeSplit::class)
                ->sort(),

            TD::make('Ações')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (User $user) => Link::make('Editar')
                    ->route('platform.systems.users.edit', $user)
                    ->icon('bs.pencil')),
        ];
    }
}
