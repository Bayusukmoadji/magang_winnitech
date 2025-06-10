<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NewsArticleController;
use App\Http\Controllers\Api\LaunchProductController; // Tambahkan use statement ini

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rute untuk News Articles
Route::apiResource('news-articles', NewsArticleController::class);

// Rute untuk Launch Products
Route::apiResource('launch-products', LaunchProductController::class);
