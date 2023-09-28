<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WordController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/admin', DashboardController::class)
    ->middleware(['auth', 'verified', Admin::class])
    ->name('dashboard');

Route::resource('category', CategoryController::class)
    ->except(['show', 'create'])
    ->middleware(['auth', 'verified', Admin::class]);

Route::resource('word', WordController::class)
    ->except(['show', 'create'])
    ->middleware(['auth', 'verified', Admin::class]);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
