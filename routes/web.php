<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [\App\Http\Controllers\PostController::class, 'index'])->name('dashboard');

Route::get('/sobre', [\App\Http\Controllers\PageController::class, 'sobre'])->name('sobre');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('posts', \App\Http\Controllers\PostController::class);
    Route::get('/publicar', [\App\Http\Controllers\PostController::class, 'create'])->name('posts.create');
    Route::post('/publicar', [\App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/vote', [\App\Http\Controllers\VoteController::class, 'vote'])->name('posts.vote')->middleware('auth');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store')->middleware('auth');
});


Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::post('/profile', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
});

Route::get('/explorar', [\App\Http\Controllers\ExploreController::class, 'index'])->name('explore.index');
Route::get('/explorar/buscar', [\App\Http\Controllers\ExploreController::class, 'search'])->name('explore.search');

require __DIR__.'/auth.php';
