<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // public function dashboard_CobaLayout()
    // {
    //     return view('admin.dashboard_CobaLayout');
    // }
    // public function perusahaan_CobaLayout()
    // {
    //     return view('admin.perusahaan_CobaLayout');
    // }
    // public function lowongan_CobaLayout()
    // {
    //     return view('admin.lowongan_CobaLayout');
    // }
    // public function profil_CobaLayout()
    // {
    //     return view('admin.profil_CobaLayout');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('aldo.index', [
            'activeMenu' => 'dashboard',
            'title' => 'JTIntern - Sistem Rekomendasi Tempat Magang',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminModel $adminModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminModel $adminModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminModel $adminModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminModel $adminModel)
    {
        //
    }
}
