<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
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
// Route::Resource('articles', ArticleController::class);
Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::post('articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::get('articles/{article:slug}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::get('articles/{article:slug}', [ArticleController::class, 'showArticle'])->name('articles.show');
Route::put('articles/{article:slug}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('articles/{article:slug}', [ArticleController::class, 'destroy'])->name('articles.destroy');

// comment
Route::post('comment', [CommentController::class, 'store'])->name('comment.store');
Route::delete('comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
Route::put('comment/{comment}', [CommentController::class, 'update'])->name('comment.update');

// like
Route::post('like', [LikeController::class, 'store'])->name('like.store');


Route::middleware(['admin'])->group(function () {
});

Route::middleware(['auth'])->group(function () {
});

// product and category
Route::Resource('category', CategoryController::class);
Route::Resource('product', ProductController::class);

//profile
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile',[ProfileController::class,'update'])->name('profile_update');