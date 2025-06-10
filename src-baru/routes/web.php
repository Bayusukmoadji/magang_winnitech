<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/* NOTE: Do Not Remove
/ Livewire asset handling if using sub folder in domain
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});
/*
/ END
*/
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [FrontendController::class, 'index']);
Route::get('/news', [FrontendController::class, 'news']);
Route::get('/techstocks', [FrontendController::class, 'techstocks']);
Route::get('/techstocks', [FrontendController::class, 'techstocks']);
Route::get('/launches', [FrontendController::class, 'launches']);
Route::get('/detailNews', [FrontendController::class, 'detailNews']);
Route::get('/detailLaunches', [FrontendController::class, 'detailLaunches']);
