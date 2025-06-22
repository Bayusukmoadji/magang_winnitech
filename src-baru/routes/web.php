<?php

use App\Http\Controllers\FrontendController;
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
Route::get('/techstocks', [FrontendController::class, 'techstocks'])->name('front.techstocks');
Route::get('/launches', [FrontendController::class, 'launches'])->name('front.launches');
Route::get('/detailNews/{newsArticle:slug}', [FrontendController::class, 'details'])->name('front.details');
Route::get('/detailLaunches', [FrontendController::class, 'detailLaunches'])->name('front.detailLaunches');

// === COMMENT & REPLY ROUTES ===
Route::post('/comments', [FrontendController::class, 'storeComment'])->name('comments.store');
Route::post('/replies', [FrontendController::class, 'storeReply'])->name('replies.store');
Route::get('/load-comments', [FrontendController::class, 'loadMoreComments'])->name('comments.load_more');

// === SEARCH ROUTE ===
Route::get('/search', [FrontendController::class, 'search'])->name('search.index');


// === API ROUTES (jika digunakan oleh JS) ===
Route::get('/api/search-news', [FrontendController::class, 'apiSearch'])->name('api.news.search');

// Route API untuk fitur "Load More" di halaman News
Route::get('/api/load-more-news', [FrontendController::class, 'loadMoreNews'])->name('news.load-more-api');

// Route API untuk fitur "Load More" di halaman Launches
Route::get('/api/launches/load-more', [FrontendController::class, 'loadMoreLaunches'])->name('launches.load-more-api');

// Route API untuk pencarian di halaman Launches
Route::get('/api/search-launches', [FrontendController::class, 'apiSearchLaunches'])->name('api.launches.search');
