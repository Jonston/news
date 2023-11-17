<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('cabinet')->group(function () {
    Route::resource('/posts', PostController::class)->only('index');
    Route::resource('/profiles', ProfileController::class)->only(['edit', 'update', 'destroy']);
})->name('cabinet.');

Route::prefix('admin')->group(function () {
    Route::resource('/posts', PostController::class)->except('show');
})->name('admin.');
