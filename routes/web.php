<?php

use App\Http\Controllers\HomepageController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [HomepageController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');