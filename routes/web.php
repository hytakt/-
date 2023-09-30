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
    Route::get('/posts', 'index')->middleware(['auth', 'verified'])->name('index');
    Route::get('/posts/create', 'create')->name('create');
    Route::get('/mypage', 'mypageIndex')->name('mypageIndex');
    Route::post('/posts/like', 'like')->name('posts.like');
    Route::post('/posts', 'store')->name('posts.store');
    Route::put('/posts/{post}', 'update')->name('update');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::post('/posts/{post}', 'comment')->name('comment');
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
    Route::delete('/posts/{post}', 'delete')->name('delete');
    Route::get('/searchIndex', 'searchIndex')->name('search.Index');
    Route::get('/search', 'search')->name('search');
    Route::get('/prefecture/{id}', 'prefecture')->name('prefecture');
    Route::get('/map', 'map')->name('map');
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::delete('/posts/{post}/unbookmark', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get('/bookmarks', [BookmarkController::class, 'bookmarkIndex'])->name('bookmark.index');
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
