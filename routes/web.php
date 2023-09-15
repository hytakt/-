<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookmarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/posts', 'index')->name('index');
    Route::get('/posts/create', 'create')->name('create');
    Route::post('/posts', 'store')->name('store');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::post('/posts/like', [PostController::class, 'like'])->name('posts.like');
    Route::get('/bookmarks', [PostPostController::class, 'bookmark_articles'])->name('bookmarks');
    Route::resource('/articles', PostPostController::class);
    Route::delete('/posts/{post}', 'delete')->name('delete');
});

Route::group(['middleware' => ['auth']], function () {
    // Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/articles/{article}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/articles/{article}/unbookmark', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
});

Route::put('/images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
