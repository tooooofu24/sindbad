<?php

use App\Http\Controllers\RedirectController;
use App\Http\Controllers\Web\ApiWebAuthController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    // version0.0(demo)
    Route::group(['prefix' => 'v0', 'as' => 'v0'], function () {
        // 認証不要ルート
        Route::post('register', App\Http\Controllers\v0\RegisterController::class)->name('register');
        Route::post('login', App\Http\Controllers\v0\LoginController::class)->name('login');
        Route::post('login-with-email', App\Http\Controllers\v0\LoginWithEmailController::class)->name('login-with-email');
        Route::get('searchGoogle', App\Http\Controllers\v0\SearchGoogle::class);
        Route::get('search-google', App\Http\Controllers\v0\SearchGoogle::class);

        // 認証が必要なルート
        Route::middleware('auth:sanctum')->group(function () {
            Route::apiResource('users', App\Http\Controllers\v0\UserController::class);
            Route::apiResource('favorites', App\Http\Controllers\v0\FavoriteController::class);
            Route::apiResource('plans', App\Http\Controllers\v0\PlanController::class);
            Route::apiResource('plan-elements', App\Http\Controllers\v0\PlanElementController::class);
            Route::apiResource('spots', App\Http\Controllers\v0\SpotController::class);
            Route::post('block', [App\Http\Controllers\v0\BlockController::class, 'block']);
            Route::post('unblock', [App\Http\Controllers\v0\BlockController::class, 'unblock']);
        });
    });

    // 認証時のリダイレクト用ルート
    Route::get('redirect', function () {
        return response('Unauthorized', 401)->header('Content-Type', 'text/plain');
    })->name('redirect');
});
