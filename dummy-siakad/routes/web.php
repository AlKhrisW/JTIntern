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
    Route::get('/create', [ProgramStudiModelController::class, 'create'])->name('create');
    Route::post('/store', [ProgramStudiModelController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ProgramStudiModelController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ProgramStudiModelController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [ProgramStudiModelController::class, 'delete'])->name('delete');
    Route::post('/destroy/{id}', [ProgramStudiModelController::class, 'destroy'])->name('destroy');
});

Route::prefix('mata-kuliah')->name('matkul.')->group(function () {
    Route::get('/', [MataKuliahModelController::class, 'index'])->name('index');
    Route::post('/list', [MataKuliahModelController::class, 'list'])->name('list');
    Route::get('/show/{id}', [MataKuliahModelController::class, 'show'])->name('show');
    Route::get('/create', [MataKuliahModelController::class, 'create'])->name('create');
    Route::post('/store', [MataKuliahModelController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [MataKuliahModelController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [MataKuliahModelController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [MataKuliahModelController::class, 'delete'])->name('delete');
    Route::post('/destroy/{id}', [MataKuliahModelController::class, 'destroy'])->name('destroy');
});

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/', [MahasiswaModelController::class, 'index'])->name('index');
    Route::post('/list', [MahasiswaModelController::class, 'list'])->name('list');
    Route::get('/show/{id}', [MahasiswaModelController::class, 'show'])->name('show');
    Route::get('/create', [MahasiswaModelController::class, 'create'])->name('create');
    Route::post('/store', [MahasiswaModelController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [MahasiswaModelController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [MahasiswaModelController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [MahasiswaModelController::class, 'delete'])->name('delete');
    Route::post('/destroy/{id}', [MahasiswaModelController::class, 'destroy'])->name('destroy');
});

Route::prefix('nilai-mahasiswa')->name('nilai.')->group(function () {
    Route::get('/', [NilaiModelController::class, 'index'])->name('index');
    Route::post('/list', [NilaiModelController::class, 'list'])->name('list');
    Route::get('/show/{id}', [NilaiModelController::class, 'show'])->name('show');
    Route::get('/create', [NilaiModelController::class, 'create'])->name('create');
    Route::post('/store', [NilaiModelController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [NilaiModelController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [NilaiModelController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [NilaiModelController::class, 'delete'])->name('delete');
    Route::post('/destroy/{id}', [NilaiModelController::class, 'destroy'])->name('destroy');
});