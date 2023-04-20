<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Auth;
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
    return view('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/nav', '_test');

// Articles
Route::Resource('articles', ArticleController::class);
Route::get('articles/{article:slug}', [ArticleController::class, 'showArticle'])->name('articles.show');
// comment
Route::get('comment', [ArticleController::class, 'comment'])->name('comment');
Route::middleware(['admin'])->group(function () {
});

Route::middleware(['auth'])->group(function () {
});
