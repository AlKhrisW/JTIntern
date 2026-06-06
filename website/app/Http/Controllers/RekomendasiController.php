<?php

namespace App\Http\Controllers;

use App\Models\ProfilMahasiswaModel;
use App\Models\MinatBidangModel;
use App\Models\RekomendasiModel;
use App\Models\SkillModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('rekomendasi.index', [
            'activeMenu' => 'rekomendasi',
            'title' => 'Rekomendasi - JTIntern',
        ]);
    }

    public function hasil()
    {
        $hasil = session('hasil_rekomendasi');
 
        if (! $hasil) {
            return redirect()
                ->route('rekomendasi.index')
                ->with('error', 'Sesi hasil rekomendasi tidak ditemukan atau sudah kedaluwarsa. Silakan cari ulang.');
        }
 
        return view('rekomendasi.hasil', [
            'title'         => 'Hasil Rekomendasi - JTIntern',
            'mahasiswa'     => $hasil['mahasiswa'],
            'rekomendasi'   => $hasil['rekomendasi'],
            'generated_at'  => $hasil['generated_at'],
        ]);
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
    public function show(RekomendasiModel $rekomendasiModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RekomendasiModel $rekomendasiModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RekomendasiModel $rekomendasiModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RekomendasiModel $rekomendasiModel)
    {
        //
    }
}
