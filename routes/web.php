<?php

use App\Http\Controllers\Web\EmailVerifyController;
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

Route::get('/completeVerification', [EmailVerifyController::class, 'completeVerification'])->name('completeVerification');
Route::get('/failVerification', [EmailVerifyController::class, 'failVerification'])->name('failVerification');

Route::get('/spotUpload', [SpotUploadController::class, 'index'])->name('spotUpload.index');
Route::post('/spotUpload/csv', [SpotUploadController::class, 'csvUpload'])->name('spotUpload.csv');
Route::post('/spotUpload', [SpotUploadController::class, 'upload'])->name('spotUpload.upload');
