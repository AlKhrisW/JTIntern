<?php

namespace App\Http\Controllers;

use App\Models\RekomendasiModel;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    private function getHasil(): ?array
    {
        return session('hasil_rekomendasi');
    }

    public function index()
    {
        return view('rekomendasi.index', [
            'activeMenu' => 'rekomendasi',
            'title'      => 'Rekomendasi - JTIntern',
        ]);
    }

    public function hasil()
    {
        $hasil = $this->getHasil();

        if (! $hasil) {
            return redirect()
                ->route('rekomendasi')
                ->with('error', 'Sesi hasil rekomendasi tidak ditemukan atau sudah kedaluwarsa. Silakan cari ulang.');
        }

        return view('rekomendasi.hasil', [
            'activeMenu'   => 'rekomendasi',
            'title'        => 'Hasil Rekomendasi - JTIntern',
            'mahasiswa'    => $hasil['mahasiswa'],
            'rekomendasi'  => $hasil['rekomendasi'],
            'generated_at' => $hasil['generated_at'],
        ]);
    }

    /**
     * Halaman detail satu lowongan dari hasil rekomendasi.
     */
    public function show($lowongan_id)
    {
        $hasil = $this->getHasil();

        if (! $hasil) {
            return redirect()
                ->route('rekomendasi')
                ->with('error', 'Sesi hasil rekomendasi tidak ditemukan atau sudah kedaluwarsa. Silakan cari ulang.');
        }

        // Ambil detail lowongan dari API internal
        try {
            $response = Http::timeout(10)->get('https://jti-portal.vercel.app/api/detail/' . $lowongan_id);

            if (! $response->successful()) {
                return redirect()
                    ->route('rekomendasi.hasil')
                    ->with('error', 'Gagal mengambil data lowongan. Silakan coba lagi.');
            }

            $json = $response->json();

            if (empty($json['success']) || empty($json['data'])) {
                return redirect()
                    ->route('rekomendasi.hasil')
                    ->with('error', 'Data lowongan tidak ditemukan.');
            }

            $data = $json['data'];

        } catch (\Exception $e) {
            return redirect()
                ->route('rekomendasi.hasil')
                ->with('error', 'Koneksi ke server gagal: ' . $e->getMessage());
        }

        $rekomendasiItem = collect($hasil['rekomendasi'])
            ->firstWhere('lowongan_id', $lowongan_id);

        $skorEdas = $rekomendasiItem ? (float) ($rekomendasiItem['skor_edas'] ?? 0) : 0;
        $persen   = min(100, round($skorEdas * 100));

        return view('rekomendasi.detail', [
            'activeMenu' => 'rekomendasi',
            'title'      => ($data['posisi'] ?? 'Detail Lowongan') . ' - JTIntern',
            'lowongan'   => $data,
            'persen'     => $persen,
        ]);
    }

    public function reset()
    {
        session()->forget('hasil_rekomendasi');
 
        return redirect()->route('rekomendasi');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(RekomendasiModel $rekomendasiModel)
    {
        //
    }

    public function update(Request $request, RekomendasiModel $rekomendasiModel)
    {
        //
    }

    public function destroy(RekomendasiModel $rekomendasiModel)
    {
        //
    }
}