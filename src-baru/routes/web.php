<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CommentController; // 1. PASTIKAN INI DITAMBAHKAN
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(config('app.asset_prefix') . '/livewire/update', $handle);
});

Livewire::setScriptRoute(function ($handle) {
    return Route::get(config('app.asset_prefix') . '/livewire/livewire.js', $handle);
});

// === FRONTEND ROUTES ===
Route::get('/', [FrontendController::class, 'index'])->name('front.home');
Route::get('/news', [FrontendController::class, 'news'])->name('front.news');
Route::get('/techstocks', [FrontendController::class, 'techstocks'])->name('front.techstocks'); // Duplikat sudah dihapus
Route::get('/launches', [FrontendController::class, 'launches'])->name('front.launches');
Route::get('/detailNews/{newsArticle:slug}', [FrontendController::class, 'details'])->name('front.details');
Route::get('/detailLaunches', [FrontendController::class, 'detailLaunches'])->name('front.detailLaunches');


// === COMMENT & REPLY ROUTES ===
// 2. DUA ROUTE INI YANG MENYELESAIKAN ERROR ANDA
Route::post('/comments', [FrontendController::class, 'storeComment'])->name('comments.store');
Route::post('/replies', [FrontendController::class, 'storeReply'])->name('replies.store');
