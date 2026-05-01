<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\RekomendasiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
Route::get('/', function () {
    return view('welcome', [
        'title' => 'JTIntern - Sistem Rekomendasi Tempat Magang',
    ]);
})->name('home');

// Tentang Kami
Route::get('/tentang', function () {
    return view('tentang', [
        'title' => 'Tentang Kami - JTIntern',
    ]);
})->name('tentang');

// Login route (placeholder — ganti dengan controller saat auth sudah dibuat)
Route::get('/login', function () {
    return redirect('/');
})->name('login');

// sementara TANPA middleware dan auth controller, nanti ditambahkan setelah auth selesai dibuat
Route::prefix('admin')->name('admin.')->group(function () {
    //buat coba layout sidebar
    Route::get('/dashboard_CobaLayout', [AdminController::class, 'dashboard_CobaLayout'])->name('dashboard_CobaLayout');
    Route::get('/perusahaan_CobaLayout', [AdminController::class, 'perusahaan_CobaLayout'])->name('perusahaan_CobaLayout');
    Route::get('/lowongan_CobaLayout', [AdminController::class, 'lowongan_CobaLayout'])->name('lowongan_CobaLayout');
    Route::get('/profil_CobaLayout', [AdminController::class, 'profil_CobaLayout'])->name('profil_CobaLayout');

    Route::prefix('perusahaan')->name('perusahaan.')->group(function () {
        Route::get('/', [PerusahaanController::class, 'index'])->name('index');
        Route::post('/list', [PerusahaanController::class, 'list'])->name('list');
        Route::get('/create_ajax', [PerusahaanController::class, 'create_ajax'])->name('create_ajax');
        Route::post('/store_ajax', [PerusahaanController::class, 'store_ajax'])->name('store_ajax');
        Route::get('/edit_ajax/{id}', [PerusahaanController::class, 'edit_ajax'])->name('edit_ajax');
        Route::put('/update_ajax/{id}', [PerusahaanController::class, 'update_ajax'])->name('update_ajax');
        Route::delete('/delete_ajax/{id}', [PerusahaanController::class, 'delete_ajax'])->name('delete_ajax');
    });

    // Route::prefix('lowongan')->name('lowongan.')->group(function () {
    //     Route::get('/', [LowonganController::class, 'index'])->name('index');
    //     Route::post('/list', [LowonganController::class, 'list'])->name('list');
    //     Route::get('/create_ajax', [LowonganController::class, 'create_ajax'])->name('create_ajax');
    //     Route::post('/store_ajax', [LowonganController::class, 'store_ajax'])->name('store_ajax');
    //     Route::get('/edit_ajax/{id}', [LowonganController::class, 'edit_ajax'])->name('edit_ajax');
    //     Route::put('/update_ajax/{id}', [LowonganController::class, 'update_ajax'])->name('update_ajax');
    //     Route::delete('/delete_ajax/{id}', [LowonganController::class, 'delete_ajax'])->name('delete_ajax');
    // });

    Route::get('/lowongan', [LowonganController::class, 'index']);
    Route::get('/lowongan/{id}', [LowonganController::class, 'show']);
    Route::post('/lowongan', [LowonganController::class, 'store']);
    Route::put('/lowongan/{id}', [LowonganController::class, 'update']);
    Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy']);

    Route::prefix('profil')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.profil.index');
        Route::post('/update', [AdminController::class, 'profil_update'])->name('admin.profil.update');
        Route::post('/change_password', [AdminController::class, 'profil_changePassword'])->name('admin.profil.change_password');
        Route::post('/update_picture', [AdminController::class, 'profil_updatePicture'])->name('admin.profil.update_picture');
    });
});
