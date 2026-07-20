<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Models\CollectionRequest;
use App\Models\User;
use App\Models\WasteRecord;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class PlatformScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'metrics' => [
                'users' => ['value' => User::query()->count()],
                'residents' => ['value' => User::query()->where('role', User::ROLE_RESIDENT)->count()],
                'partners' => ['value' => User::query()->where('role', User::ROLE_PARTNER)->count()],
                'wasteRecords' => ['value' => WasteRecord::query()->count()],
                'pendingRequests' => ['value' => CollectionRequest::query()->where('status', CollectionRequest::STATUS_PENDING)->count()],
                'completedRequests' => ['value' => CollectionRequest::query()->where('status', CollectionRequest::STATUS_COMPLETED)->count()],
            ],
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Dashboard administrativo';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Visão geral do Cultive Mais.';
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::metrics([
                'Total de usuários' => 'metrics.users',
                'Total de moradores' => 'metrics.residents',
                'Total de parceiros' => 'metrics.partners',
                'Total de resíduos' => 'metrics.wasteRecords',
                'Solicitações pendentes' => 'metrics.pendingRequests',
                'Coletas concluídas' => 'metrics.completedRequests',
            ]),
        ];
    }
}
