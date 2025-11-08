<?php

use App\Http\Controllers\BookmarkController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/posts/{post}/like', [LikeController::class, 'destroy'])->name('likes.destroy');
    Route::get('/likes', [LikeController::class, 'index'])->name('likes.index');

    Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
    Route::delete('/posts/{post}/bookmark', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/profile/{username}', [PostController::class, 'profile'])->name('profile');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
