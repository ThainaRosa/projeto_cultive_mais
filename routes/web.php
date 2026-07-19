<?php

use App\Http\Controllers\Resident\CollectionRequestController;
use App\Http\Controllers\Resident\DashboardController;
use App\Http\Controllers\Resident\WasteRecordController;
use App\Models\CollectionPoint;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::view('/como-funciona', 'public.how-it-works')->name('how-it-works');
Route::view('/residuos-organicos', 'public.organic-waste')->name('organic-waste');
Route::get('/pontos-de-coleta', function () {
    return view('public.collection-points', [
        'collectionPoints' => CollectionPoint::query()
            ->where('active', true)
            ->orderBy('name')
            ->get(),
    ]);
})->name('collection-points');

Route::middleware(['auth', 'verified', 'resident'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('morador')->name('resident.')->group(function () {
        Route::get('/residuos', [WasteRecordController::class, 'index'])->name('waste-records.index');
        Route::get('/residuos/cadastrar', [WasteRecordController::class, 'create'])->name('waste-records.create');
        Route::post('/residuos', [WasteRecordController::class, 'store'])->name('waste-records.store');
        Route::get('/residuos/{wasteRecord}', [WasteRecordController::class, 'show'])->name('waste-records.show');
        Route::get('/residuos/{wasteRecord}/editar', [WasteRecordController::class, 'edit'])->name('waste-records.edit');
        Route::put('/residuos/{wasteRecord}', [WasteRecordController::class, 'update'])->name('waste-records.update');
        Route::patch('/residuos/{wasteRecord}/cancelar', [WasteRecordController::class, 'cancel'])->name('waste-records.cancel');
        Route::post('/residuos/{wasteRecord}/solicitacao', [CollectionRequestController::class, 'store'])->name('collection-requests.store');

        Route::get('/solicitacoes', [CollectionRequestController::class, 'index'])->name('collection-requests.index');
        Route::get('/solicitacoes/{collectionRequest}', [CollectionRequestController::class, 'show'])->name('collection-requests.show');
        Route::patch('/solicitacoes/{collectionRequest}/cancelar', [CollectionRequestController::class, 'cancel'])->name('collection-requests.cancel');
    });
});
