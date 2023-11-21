<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
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
Route::get('/', [AuthController::class, 'loginForm'])->middleware(['authenticated'])->name('home');
Route::get('login', [AuthController::class, 'loginForm'])->middleware(['authenticated'])->name('login-form');
Route::post('login', [AuthController::class, 'login'])->middleware(['authenticated'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->middleware(['auth'])->name('logout');

Route::prefix('cabinet')->name('cabinet.')->middleware(['auth', 'role:customer'])->group(function () {
    Route::resource('/posts', PostController::class)->only('index');
    Route::resource('/profiles', ProfileController::class)->only(['edit', 'update', 'destroy']);
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('/posts', PostController::class)->except('show')
        ->names('posts');

    Route::get('/random-image', [ImageController::class, 'random'])->name('random-image');
});
