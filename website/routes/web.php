<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing Page
// Route::get('/', function () {
//     return view('welcome', [
//         'title' => 'JTIntern - Sistem Rekomendasi Tempat Magang',
//     ]);
// })->name('home');

// // Tentang Kami
// Route::get('/tentang', function () {
//     return view('tentang', [
//         'title' => 'Tentang Kami - JTIntern',
//     ]);
// })->name('tentang');

// // Login route (placeholder — ganti dengan controller saat auth sudah dibuat)
// Route::get('/login', function () {
//     return redirect('/');
// })->name('login');

Route::get('/', function () {
    return view('guest.index');
});