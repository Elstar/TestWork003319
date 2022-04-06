<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('check.api.token')->group(function () {
    Route::group(['prefix' => 'article',], function () {
        Route::get('get', [ArticleController::class, 'index']);
        Route::get('get/{article}', [ArticleController::class, 'show']);
        Route::post('create', [ArticleController::class, 'store']);
        Route::put('{article}', [ArticleController::class, 'update']);
        Route::delete('{article}', [ArticleController::class, 'destroy']);
    });
    Route::group(['prefix' => 'tag',], function () {
        Route::get('get', [TagController::class, 'index']);
        Route::get('get/{tag}', [TagController::class, 'show']);
        Route::post('create', [TagController::class, 'store']);
        Route::put('{tag}', [TagController::class, 'update']);
        Route::delete('{tag}', [TagController::class, 'destroy']);
    });
});
