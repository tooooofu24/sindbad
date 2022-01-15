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

// スポットアップロード
Route::get('/spot-upload', [SpotUploadController::class, 'index'])->name('spotUpload.index');
Route::get('/spotUpload', function () {
    return redirect()->route('spotUpload.index');
});
Route::post('/spot-upload/csv', [SpotUploadController::class, 'csvUpload'])->name('spotUpload.csv');
Route::post('/spot-upload', [SpotUploadController::class, 'upload'])->name('spotUpload.upload');

Route::get('/spots', [SpotController::class, 'index'])->name('spots.index');
