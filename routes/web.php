<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MountainsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [HomepageController::class, 'index'])
    ->name('homepage');

Route::prefix('members/{id}')->group(function () {
    Route::get('/', [UsersController::class, 'user'])
        ->name('users.user');

    Route::get('/mountains', [UsersController::class, 'mountains'])
        ->name('users.mountains');

    Route::get('/mountains/{mountainId}', [UsersController::class, 'mountain'])
        ->whereNumber('mountainId')
        ->name('users.mountain');

    Route::get('/seasons', [UsersController::class, 'seasons'])
        ->name('users.seasons');

    Route::get('/seasons/{seasonId}', [UsersController::class, 'season'])
        ->whereNumber('seasonId')
        ->name('users.season');

    Route::get('/snowdays', [UsersController::class, 'snowdays'])
        ->name('users.snowdays');

    Route::get('/snowdays/{snowdayId}', [UsersController::class, 'snowday'])
        ->whereNumber('snowdayId')
        ->name('users.snowday');

    Route::get('/following', [UsersController::class, 'following'])
        ->name('users.following');
});

Route::prefix('mountains')->group(function () {
    Route::get('/{id}', [MountainsController::class, 'mountain'])
        ->whereNumber('id')
        ->name('mountains.mountain');

    Route::get('/', [MountainsController::class, 'browse'])
        ->name('mountains.browse');

    Route::get('/{region1?}/{region2?}/{region3?}', [MountainsController::class, 'browseRegion'])
        ->name('mountains.browse.region');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');