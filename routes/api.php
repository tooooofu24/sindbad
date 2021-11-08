<?php

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

// version0.0(demo)
Route::group(['prefix' => 'v0'], function () {
    // ログインが必要なルート
    Route::middleware('auth:sanctum')->group(function () {
    });
});

// ログインが必要なルート

Route::middleware('auth:sanctum')->group(function () {

    Route::group(['prefix' => 'plans'], function () {
        // Plan作成
        Route::post('/', 'PlanController@create');
        // Plan全取得
        Route::get('/', 'PlanController@get_all');
        // Planを1つ取得
        Route::get('/{id}', 'PlanController@get_one');
        // Plan更新
        Route::post('/{id}', 'PlanController@update');
        // Plan削除
        Route::delete('/{id}', 'PlanController@delete');
    });

    Route::group(['prefix' => 'spots'], function () {
        // Spot作成
        Route::post('/', 'SpotController@create');
        // Spot取得（検索）
        Route::get('/', 'SpotController@get');
    });
    Route::group(['prefix' => 'favorites'], function () {
        // お気に入りに追加
        Route::post('/{plan_id}', 'FavoriteController@fav');
        // お気に入り削除
        Route::delete('/{plan_id}', 'FavoriteController@delete');
        // お気に入りを取得
        Route::get('/', 'FavoriteController@get');
    });

    // メアド、パスワード登録
    Route::post('auth/register', 'AuthController@register');

    // プロフィール編集
    Route::post('profile', 'ProfileController@update');
});

// ログイン不要なルート

// サインアップ（初回起動時）
Route::post('signup', 'UserController@signup');
// ログイン（2回目以降起動時）
Route::post('login', 'UserController@login');

Route::group(['prefix' => 'auth'], function () {
    // メアド、パスワード認証
    Route::post('/login', 'AuthController@login');
});

// テスト用ルート
Route::get('test', 'UserController@test');

// ログインできていない時のリダイレクト用ルート
Route::get('redirect', 'UserController@redirect')->name('redirect');
