<?php

use Illuminate\Support\Facades\Route;

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
    $view = view('welcome');
    // トップディレクトリアクセス時にイベントを発行する場合
    \Illuminate\Support\Facades\Event::dispatch(new \App\Events\PublishProcessor(2));

    return $view;
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('pdf', \App\Http\Controllers\PdfGeneratorAction::class);

require __DIR__.'/auth.php';
