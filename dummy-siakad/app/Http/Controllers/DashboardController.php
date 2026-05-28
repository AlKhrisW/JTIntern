<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page = (object) [
            'title' => 'Selamat datang di dashboard aplikasi siakad'
        ];

        $activeMenu = 'dashboard';

        return view('dashboard', [
            'breadcrumb' => 'Selamat datang di dashboard siakad',
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }
}
