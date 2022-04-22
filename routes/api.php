<?php

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

Route::group(['as' => 'api.'], function () {

    // 認証不要ルート
    Route::post('register', App\Http\Controllers\Api\RegisterController::class)->name('register');
    Route::post('login', App\Http\Controllers\Api\LoginController::class)->name('login');
    Route::post('login-with-email', App\Http\Controllers\Api\LoginWithEmailController::class)->name('login-with-email');
    Route::get('searchGoogle', App\Http\Controllers\Api\SearchGoogle::class);
    Route::get('search-google', App\Http\Controllers\Api\SearchGoogle::class);

    // 認証が必要なルート
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
        Route::apiResource('favorites', App\Http\Controllers\Api\FavoriteController::class);
        Route::apiResource('plans', App\Http\Controllers\Api\PlanController::class);
        Route::apiResource('plan-elements', App\Http\Controllers\Api\PlanElementController::class);
        Route::apiResource('spots', App\Http\Controllers\Api\SpotController::class);
        Route::post('block', [App\Http\Controllers\Api\BlockController::class, 'block']);
        Route::post('unblock', [App\Http\Controllers\Api\BlockController::class, 'unblock']);
        Route::apiResource('reports', App\Http\Controllers\Api\ReportController::class);
        Route::post('admin/auth', App\Http\Controllers\Api\AdminLoginController::class);
    });


    // 認証時のリダイレクト用ルート
    Route::get('redirect', function () {
        return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
    })->name('unauthorized');
});
