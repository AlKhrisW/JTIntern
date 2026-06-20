<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerusahaanModelController;
use App\Http\Controllers\LowonganModelController;

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
    Route::get('/', [PerusahaanModelController::class, 'index'])->name('index');
    Route::post('/list', [PerusahaanModelController::class, 'list'])->name('list');
    Route::get('/show_ajax/{id}', [PerusahaanModelController::class, 'show_ajax'])->name('show_ajax');
    Route::get('/create_ajax', [PerusahaanModelController::class, 'create_ajax'])->name('create_ajax');
    Route::post('/store_ajax', [PerusahaanModelController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/edit_ajax/{id}', [PerusahaanModelController::class, 'edit_ajax'])->name('edit_ajax');
    Route::put('/update_ajax/{id}', [PerusahaanModelController::class, 'update_ajax'])->name('update_ajax');
    Route::get('/delete_ajax/{id}', [PerusahaanModelController::class, 'delete_ajax'])->name('delete_ajax');
    Route::post('/destroy_ajax/{id}', [PerusahaanModelController::class, 'destroy_ajax'])->name('destroy_ajax');
});

Route::prefix('lowongan')->name('lowongan.')->group(function () {
    Route::get('/', [LowonganModelController::class, 'index'])->name('index');
    Route::post('/list', [LowonganModelController::class, 'list'])->name('list');
    Route::get('/show_ajax/{id}', [LowonganModelController::class, 'show_ajax'])->name('show_ajax');
    Route::get('/create_ajax', [LowonganModelController::class, 'create_ajax'])->name('create_ajax');
    Route::post('/store_ajax', [LowonganModelController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/edit_ajax/{id}', [LowonganModelController::class, 'edit_ajax'])->name('edit_ajax');
    Route::put('/update_ajax/{id}', [LowonganModelController::class, 'update_ajax'])->name('update_ajax');
    Route::get('/delete_ajax/{id}', [LowonganModelController::class, 'delete_ajax'])->name('delete_ajax');
    Route::post('/destroy_ajax/{id}', [LowonganModelController::class, 'destroy_ajax'])->name('destroy_ajax');
});