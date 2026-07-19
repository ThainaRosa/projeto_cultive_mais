<?php

namespace App\Http\Controllers\Resident;

use App\Http\Controllers\Controller;
use App\Models\CollectionRequest;
use App\Models\WasteRecord;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        return view('resident.dashboard', [
            'availableWasteCount' => $user->wasteRecords()->where('status', WasteRecord::STATUS_AVAILABLE)->count(),
            'requestedWasteCount' => $user->wasteRecords()->where('status', WasteRecord::STATUS_REQUESTED)->count(),
            'pendingRequestCount' => $user->residentCollectionRequests()->where('status', CollectionRequest::STATUS_PENDING)->count(),
            'recentWasteRecords' => $user->wasteRecords()->with('wasteCategory')->latest()->limit(5)->get(),
        ]);
    }
}
