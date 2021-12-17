<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\MountainsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [HomepageController::class, 'index'])
    ->name('homepage');

Route::prefix('members')->group(function () {
    Route::get('/', [UsersController::class, 'browse'])
        ->name('users.browse');

    Route::get('/{id}', [UsersController::class, 'user'])
        ->whereNumber('id')
        ->name('users.user');

    Route::get('/{id}/mountains', [UsersController::class, 'mountains'])
        ->whereNumber('id')
        ->name('users.mountains');

    Route::get('/{id}/mountains/{mountainId}', [UsersController::class, 'mountain'])
        ->whereNumber('id')
        ->whereNumber('mountainId')
        ->name('users.mountain');

    Route::get('/{id}/seasons', [UsersController::class, 'seasons'])
        ->whereNumber('id')
        ->name('users.seasons');

    Route::get('/{id}/seasons/{seasonId}', [UsersController::class, 'season'])
        ->whereNumber('id')
        ->whereNumber('seasonId')
        ->name('users.season');

    Route::get('/{id}/snowdays', [UsersController::class, 'snowdays'])
        ->whereNumber('id')
        ->name('users.snowdays');

    Route::get('/{id}/snowdays/{snowdayId}', [UsersController::class, 'snowday'])
        ->whereNumber('id')
        ->whereNumber('snowdayId')
        ->name('users.snowday');

    Route::get('/{id}/following', [UsersController::class, 'following'])
        ->whereNumber('id')
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