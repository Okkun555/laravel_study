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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/publishers', [App\Http\Controllers\PublisherAction::class, 'create']);

// jwt-auth用
Route::group(['middleware' => 'api'], function ($router) {
    // ログインを行い、アクセストークンを発行するルート
    Route::post('users/login', 'App\Http\Controllers\User\LoginAction::class');
    // アクセストークンを用いて、認証ユーザーの情報を取得するルート
    Route::post('/users/', 'App\Http\Controllers\User\RetrieveAction::class')
        ->middleware('auth:jwt');
});
