<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('index', [
            'activeMenu' => 'home',
            'title' => 'JTIntern - Sistem Rekomendasi Tempat Magang',
        ]);
    }

    public function tentang()
    {
        return view('tentang', [
            'activeMenu' => 'tentang',
            'title' => 'Tentang Kami - JTIntern',
        ]);
    }

    public function masuk()
    {
        return view('admin.dashboard_CobaLayout');
    }
}
