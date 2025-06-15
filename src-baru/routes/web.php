<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/news', [FrontendController::class, 'news']);
Route::get('/techstocks', [FrontendController::class, 'techstocks']);
Route::get('/techstocks', [FrontendController::class, 'techstocks']);
Route::get('/launches', [FrontendController::class, 'launches']);
Route::get('/detailNews/{newsArticle:slug}', [FrontendController::class, 'details'])->name('front.details');
Route::get('/detailLaunches', [FrontendController::class, 'detailLaunches']);
