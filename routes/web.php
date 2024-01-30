<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlcoholController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\GoogleLoginController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('alcohols', AlcoholController::class)
    ->except('show');

Route::prefix('alcohols')
    ->controller(AlcoholController::class)
    ->name('alcohols.')
    ->group(function () {
        Route::get('/dust-box', 'dustBox')
            ->name('dust-box');
        Route::get('{alcohol}/restore', 'restore')
            ->name('restore');
        Route::post('{alcohol}/dust-box_clear', 'dustBoxClear')
            ->name('dust-box_clear');
    });

Route::prefix('images')
    ->controller(ImageController::class)
    ->name('images.')
    ->group(function () {
        Route::get('/index', 'index')
            ->name('index');
        Route::get('{image}/destroy', 'destroy')
            ->name('destroy');
    });

// Google ログインルート
Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])
    ->name('login.google.callback');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
