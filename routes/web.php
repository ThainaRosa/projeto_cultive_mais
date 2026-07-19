<?php

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
