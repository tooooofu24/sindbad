<?php

use App\Http\Controllers\RedirectController;
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

// version0.0(demo)
Route::group(['prefix' => 'v0'], function () {
    // 認証不要ルート
    Route::post('register', App\Http\Controllers\v0\RegisterController::class)->name('register');
    Route::post('login', App\Http\Controllers\v0\LoginController::class)->name('login');
    Route::post('signin', App\Http\Controllers\v0\SignInController::class);

    // 認証が必要なルート
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', App\Http\Controllers\v0\UserController::class);
        Route::apiResource('favorites', App\Http\Controllers\v0\FavoriteController::class);
        Route::apiResource('plans', App\Http\Controllers\v0\PlanController::class);
        Route::apiResource('spots', App\Http\Controllers\v0\SpotController::class);
        Route::post('signup', App\Http\Controllers\v0\SignUpController::class);
    });
});

Route::get('emailTest', function () {
    $user = User::find(1);
    $user->sendEmailVerificationNotification();
});

// 認証時のリダイレクト用ルート
Route::get('redirect', function () {
    return response('Unauthorized', 401);
})->name('redirect');
