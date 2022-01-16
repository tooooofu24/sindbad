<?php

use App\Http\Controllers\Web\EmailVerifyController;
use App\Http\Controllers\Web\SpotController;
use App\Http\Controllers\Web\SpotUploadController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/complete-verification', [EmailVerifyController::class, 'completeVerification'])->name('completeVerification');
Route::get('/fail-verification', [EmailVerifyController::class, 'failVerification'])->name('failVerification');

// スポット
Route::group(['prefix' => 'spots', 'as' => 'spots.'], function () {
    // スポット一覧
    Route::get('/', [SpotController::class, 'index'])->name('index');
    // スポット更新
    Route::post('/{id}/update-image', [SpotController::class, 'updateImage'])->name('updateImage');
    // スポット追加画面
    Route::group(['prefix' => 'create', 'as' => 'create.'], function () {
        Route::get('/', [SpotController::class, 'create'])->name('index');
        Route::post('/', [SpotController::class, 'store'])->name('store');
        Route::post('/csv', [SpotController::class, 'storeWithCsv'])->name('csv');
    });
});

Route::get('/spotUpload', function () {
    return redirect()->route('spots.create.index');
});
