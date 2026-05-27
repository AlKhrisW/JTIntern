<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramStudiModelController;
use App\Http\Controllers\MataKuliahModelController;
use App\Http\Controllers\MahasiswaModelController;
use App\Http\Controllers\NilaiModelController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('program-studi')->name('prodi.')->group(function () {
    Route::get('/', [ProgramStudiModelController::class, 'index'])->name('index');
    Route::post('/list', [ProgramStudiModelController::class, 'list'])->name('list');
    Route::get('/show_ajax/{id}', [ProgramStudiModelController::class, 'show_ajax'])->name('show_ajax');
    Route::get('/create_ajax', [ProgramStudiModelController::class, 'create_ajax'])->name('create_ajax');
    Route::post('/store_ajax', [ProgramStudiModelController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/edit_ajax/{id}', [ProgramStudiModelController::class, 'edit_ajax'])->name('edit_ajax');
    Route::put('/update_ajax/{id}', [ProgramStudiModelController::class, 'update_ajax'])->name('update_ajax');
    Route::get('/delete_ajax/{id}', [ProgramStudiModelController::class, 'delete_ajax'])->name('delete_ajax');
    Route::post('/destroy_ajax/{id}', [ProgramStudiModelController::class, 'destroy_ajax'])->name('destroy_ajax');
});

Route::prefix('mata-kuliah')->name('matkul.')->group(function () {
    Route::get('/', [MataKuliahModelController::class, 'index'])->name('index');
    Route::post('/list', [MataKuliahModelController::class, 'list'])->name('list');
    Route::get('/show_ajax/{id}', [MataKuliahModelController::class, 'show_ajax'])->name('show_ajax');
    Route::get('/create_ajax', [MataKuliahModelController::class, 'create_ajax'])->name('create_ajax');
    Route::post('/store_ajax', [MataKuliahModelController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/edit_ajax/{id}', [MataKuliahModelController::class, 'edit_ajax'])->name('edit_ajax');
    Route::put('/update_ajax/{id}', [MataKuliahModelController::class, 'update_ajax'])->name('update_ajax');
    Route::get('/delete_ajax/{id}', [MataKuliahModelController::class, 'delete_ajax'])->name('delete_ajax');
    Route::post('/destroy_ajax/{id}', [MataKuliahModelController::class, 'destroy_ajax'])->name('destroy_ajax');
});

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/', [MahasiswaModelController::class, 'index'])->name('index');
    Route::post('/list', [MahasiswaModelController::class, 'list'])->name('list');
    Route::get('/show_ajax/{id}', [MahasiswaModelController::class, 'show_ajax'])->name('show_ajax');
    Route::get('/create_ajax', [MahasiswaModelController::class, 'create_ajax'])->name('create_ajax');
    Route::post('/store_ajax', [MahasiswaModelController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/edit_ajax/{id}', [MahasiswaModelController::class, 'edit_ajax'])->name('edit_ajax');
    Route::put('/update_ajax/{id}', [MahasiswaModelController::class, 'update_ajax'])->name('update_ajax');
    Route::get('/delete_ajax/{id}', [MahasiswaModelController::class, 'delete_ajax'])->name('delete_ajax');
    Route::post('/destroy_ajax/{id}', [MahasiswaModelController::class, 'destroy_ajax'])->name('destroy_ajax');
});

Route::prefix('nilai-mahasiswa')->name('nilai.')->group(function () {
    Route::get('/', [NilaiModelController::class, 'index'])->name('index');
    Route::post('/list', [NilaiModelController::class, 'list'])->name('list');
    Route::get('/show_ajax/{id}', [NilaiModelController::class, 'show_ajax'])->name('show_ajax');
    Route::get('/create_ajax', [NilaiModelController::class, 'create_ajax'])->name('create_ajax');
    Route::post('/store_ajax', [NilaiModelController::class, 'store_ajax'])->name('store_ajax');
    Route::get('/edit_ajax/{id}', [NilaiModelController::class, 'edit_ajax'])->name('edit_ajax');
    Route::put('/update_ajax/{id}', [NilaiModelController::class, 'update_ajax'])->name('update_ajax');
    Route::get('/delete_ajax/{id}', [NilaiModelController::class, 'delete_ajax'])->name('delete_ajax');
    Route::post('/destroy_ajax/{id}', [NilaiModelController::class, 'destroy_ajax'])->name('destroy_ajax');
});