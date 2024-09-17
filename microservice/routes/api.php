<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/v1',
    'as' => 'api.',
], function(){
    Route::prefix('ads')->as('ads.')->group(function(){
        Route::post('/', [App\Http\Controllers\AdsController::class, 'getAd'])->name('item');
        Route::post('/list', [App\Http\Controllers\AdsController::class, 'getAds'])->name('list');
        Route::post('/create', [App\Http\Controllers\AdsController::class, 'createAd'])->name('create');
    });
});
