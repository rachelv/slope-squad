<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MountainsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [HomepageController::class, 'index'])
    ->name('homepage');

Route::prefix('members')->group(function () {
    Route::get('/{id}', [UsersController::class, 'user'])
        ->name('users.user');
});

Route::prefix('mountains')->group(function () {
    Route::get('/{id}', [MountainsController::class, 'mountain'])
        ->name('mountains.mountain');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');