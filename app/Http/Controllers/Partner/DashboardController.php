<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Models\CollectionRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $partner = $request->user();

        return view('partner.dashboard', [
            'pendingCount' => CollectionRequest::query()->where('status', CollectionRequest::STATUS_PENDING)->count(),
            'acceptedCount' => $partner->partnerCollectionRequests()->where('status', CollectionRequest::STATUS_ACCEPTED)->count(),
            'completedCount' => $partner->partnerCollectionRequests()->where('status', CollectionRequest::STATUS_COMPLETED)->count(),
            'recentPendingRequests' => CollectionRequest::query()
                ->where('status', CollectionRequest::STATUS_PENDING)
                ->with(['wasteRecord.wasteCategory', 'resident'])
                ->latest()
                ->limit(5)
                ->get(),
        ]);
    }
}
