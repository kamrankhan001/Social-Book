<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::redirect('/', 'login');

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/u/{user:username}', [ProfileController::class, 'index'])->name('profile');

Route::middleware('auth')->group(function () {
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

    Route::post('/profile/cover-update/{user}', [ProfileController::class, 'coverUpdate'])->name('profile.coverUpdate');
    Route::post('/profile/avater-update/{user}', [ProfileController::class, 'avaterUpdate'])->name('profile.avaterUpdate');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
