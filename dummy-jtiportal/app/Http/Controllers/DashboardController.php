<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $page = (object) [
            'title' => 'Selamat datang di dashboard aplikasi jtiportal'
        ];

        $activeMenu = 'dashboard';

        return view('welcome', [
            'breadcrumb' => 'Selamat datang di dashboard jtiportal',
            'page' => $page, 
            'activeMenu' => $activeMenu
        ]);
    }
}
