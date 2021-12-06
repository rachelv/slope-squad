<?php

use App\Http\Controllers\BrowseController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MountainsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [HomepageController::class, 'index'])
    ->name('homepage');

Route::prefix('browse')->group(function () {
    Route::get('/mountains', [BrowseController::class, 'mountains'])
        ->name('browse.mountains');

    // todo: add isSlug() param validation
    Route::get('/mountains/{region1?}/{region2?}/{region3?}', [BrowseController::class, 'region'])
        ->name('browse.region');
});

Route::prefix('members')->group(function () {
    Route::get('/{id}', [UsersController::class, 'user'])
        ->name('users.user');

    Route::get('/{id}/mountains', [UsersController::class, 'mountains'])
        ->name('users.mountains');

    Route::get('/{id}/seasons', [UsersController::class, 'seasons'])
        ->name('users.seasons');

    Route::get('/{id}/snowdays', [UsersController::class, 'snowdays'])
        ->name('users.snowdays');

    Route::get('/{id}/following', [UsersController::class, 'following'])
        ->name('users.following');
});

Route::prefix('mountains')->group(function () {
    Route::get('/{id}', [MountainsController::class, 'mountain'])
        ->name('mountains.mountain');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');