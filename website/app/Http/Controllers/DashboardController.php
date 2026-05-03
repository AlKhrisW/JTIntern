<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.index', [
            'activeMenu' => 'dashboard',
            'breadcrumb' => 'Welcome to Dashboard',
            'title' => 'JTIntern - Sistem Rekomendasi Tempat Magang',
        ]);
    }
}
