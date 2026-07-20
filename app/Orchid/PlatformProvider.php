<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Dashboard')
                ->icon('bs.speedometer2')
                ->title('Administração')
                ->route(config('platform.index')),

            Menu::make('Usuários')
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->permission('platform.systems.users'),

            Menu::make('Categorias de resíduos')
                ->icon('bs.tags')
                ->route('platform.categories')
                ->permission('platform.categories'),

            Menu::make('Pontos de coleta')
                ->icon('bs.geo-alt')
                ->route('platform.collection-points')
                ->permission('platform.collection-points'),

            Menu::make('Resíduos')
                ->icon('bs.recycle')
                ->route('platform.waste-records')
                ->permission('platform.waste-records'),

            Menu::make('Solicitações')
                ->icon('bs.truck')
                ->route('platform.collection-requests')
                ->permission('platform.collection-requests'),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.users', 'Usuários')
                ->addPermission('platform.categories', 'Categorias de resíduos')
                ->addPermission('platform.collection-points', 'Pontos de coleta')
                ->addPermission('platform.waste-records', 'Resíduos')
                ->addPermission('platform.collection-requests', 'Solicitações'),
        ];
    }
}
