<?php

use App\Http\Controllers\AuthController;
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
Route::get('login', [AuthController::class, 'loginForm'])->middleware('authenticated')->name('login-form');
Route::post('login', [AuthController::class, 'login'])->middleware('authenticated')->name('login');

Route::prefix('cabinet')->name('cabinet.')->middleware(['role:customer'])->group(function () {
    Route::resource('/posts', PostController::class)->only('index');
    Route::resource('/profiles', ProfileController::class)->only(['edit', 'update', 'destroy']);
});

Route::prefix('admin')->name('admin.')->middleware(['role:admin'])->group(function () {
    Route::resource('/posts', PostController::class)->except('show')
        ->names('posts');
});
