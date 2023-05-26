<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Cart\CartList;
use App\Http\Livewire\Transaction\Transaction;
use App\Http\Livewire\Auth\PwdResetConfirm;
use App\Http\Livewire\Auth\PasswordReset;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



use App\Http\Controllers\LikeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

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

Auth::routes([
    'login' => false,
    'register' => false,
    'password.request' => false,
    'verify' => true,
]);

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', PasswordReset::class)->name('forgot-password');
    Route::get('/confirm-reset', PwdResetConfirm::class)->name('confirm-reset');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 'views
Route::view('/testing', 'layouts.admin');
Route::view('/testprod', 'test.prod');


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
    // Route::get('/categoryASL',index::class)->name('categoryASL');
});

// product and category
Route::Resource('category', CategoryController::class);
Route::Resource('product', ProductController::class);

// cart
// Route::get('/cart', [ProductController::class, 'index_test']); 
// Route::view('/cart', 'dashboard.cart.index');
// Route::get('/cart', function () {
//     return view('dashboard.cart.index');
// })->middleware(['auth']);


// Route::get('/cart-list', CartList::class)->name('cart-list'); 



//profile
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile', [ProfileController::class, 'update'])->name('profile_update');

// cart
Route::view('/detail_produk', 'dashboard.product.product_detail');
Route::get('/product-list', [ProductController::class, 'list_product'])->name('product-list');
Route::middleware(['auth'])->group(function () {
    Route::view('/cart-list', 'dashboard.cart.cart_list');
    Route::view('/transaction', 'dashboard.transaction.transaction');
});
// transaction
// Route::post('/transaction', [Transaction::class, 'store'])->name('transaction.store');
