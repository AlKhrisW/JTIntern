<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\WelcomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/tentang', [WelcomeController::class, 'tentang'])->name('tentang');

Route::group(['prefix' => 'rekomendasi'], function () {
    Route::get('/', [RekomendasiController::class, 'index'])->name('rekomendasi');
    Route::get('/hasil', [RekomendasiController::class, 'hasil'])->name('rekomendasi.hasil');
    Route::get('/detail/{lowongan_id}', [RekomendasiController::class, 'show'])->name('rekomendasi.detail');
});
