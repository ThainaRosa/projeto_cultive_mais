<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use App\Models\User;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Switcher;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title('Nome')
                ->placeholder('Nome'),

            Input::make('user.email')
                ->type('email')
                ->readonly()
                ->title('E-mail'),

            Input::make('user.phone')
                ->type('text')
                ->max(255)
                ->title('Telefone'),

            Select::make('user.role')
                ->options([
                    User::ROLE_ADMIN => 'Administrador',
                    User::ROLE_RESIDENT => 'Morador',
                    User::ROLE_PARTNER => 'Parceiro',
                ])
                ->required()
                ->title('Perfil'),

            Switcher::make('user.active')
                ->sendTrueOrFalse()
                ->title('Usuário ativo'),
        ];
    }
}
