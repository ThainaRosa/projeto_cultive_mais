<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Password;
use Orchid\Screen\Layouts\Rows;

class ProfilePasswordLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Password::make('old_password')
                ->placeholder('Informe a senha atual')
                ->title('Senha atual')
                ->help('Esta é a senha atualmente definida para sua conta.'),

            Password::make('password')
                ->placeholder('Informe a nova senha')
                ->title('Nova senha'),

            Password::make('password_confirmation')
                ->placeholder('Repita a nova senha')
                ->title('Confirmar nova senha')
                ->help('Use pelo menos 8 caracteres, incluindo um número e uma letra minúscula.'),
        ];
    }
}
