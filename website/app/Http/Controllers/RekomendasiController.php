<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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
    public function show($lowongan_id)
    {
        $hasil = session('hasil_rekomendasi');

        if (! $hasil) {
            return redirect()
                ->route('rekomendasi.index')
                ->with('error', 'Sesi hasil rekomendasi tidak ditemukan atau sudah kedaluwarsa. Silakan cari ulang.');
        }

        // Fetch lowongan detail from the JTI Portal API
        try {
            $response = Http::timeout(10)->get('http://127.0.0.1:8001/api/detail/' . $lowongan_id);

            if ($response->failed()) {
                return redirect()
                    ->route('rekomendasi.hasil')
                    ->with('error', 'Gagal mengambil data lowongan. Silakan coba lagi.');
            }

            $data = $response->json();
        } catch (\Exception $e) {
            return redirect()
                ->route('rekomendasi.hasil')
                ->with('error', 'Koneksi ke server gagal: ' . $e->getMessage());
        }

        // Find the matching recommendation entry to get the skor_edas
        $rekomendasiItem = collect($hasil['rekomendasi'])
            ->firstWhere('lowongan_id', $lowongan_id);

        $skorEdas = $rekomendasiItem ? (float) ($rekomendasiItem['skor_edas'] ?? 0) : 0;
        $persen   = min(100, round($skorEdas * 100));

        return view('rekomendasi.detail', [
            'title'    => ($data['posisi'] ?? 'Detail Lowongan') . ' - JTIntern',
            'lowongan' => $data,
            'persen'   => $persen,
        ]);
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
