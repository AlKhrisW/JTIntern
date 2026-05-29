<?php

namespace App\Http\Controllers;

use App\Models\NilaiModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NilaiModelController extends Controller
{
    /* ── Index ─────────────────────────────────────────────── */
    public function index(Request $request)
    {
        $query = NilaiModel::with(['mahasiswa', 'mataKuliah']);

        if ($request->filled('id_mahasiswa')) {
            $query->where('id_mahasiswa', $request->id_mahasiswa);
        }
        if ($request->filled('id_matkul')) {
            $query->where('id_matkul', $request->id_matkul);
        }

        // preserve query string parameters for pagination links
        $nilais       = $query->paginate(10)->appends($request->query());
        $totalNilai   = NilaiModel::count();
        $mahasiswas   = MahasiswaModel::orderBy('nama_mahasiswa')->get();
        $mataKuliahs  = MataKuliahModel::orderBy('nama_matkul')->get();

        $activeMenu = 'nilai';
        $breadcrumb = 'Manajemen Nilai Mahasiswa';
        return view('nilaiMahasiswa.index', compact('nilais', 'totalNilai', 'mahasiswas', 'mataKuliahs', 'activeMenu', 'breadcrumb'));
    }

    /* ── Create (modal form) ────────────────────────────────── */
    public function create()
    {
        $mahasiswas  = MahasiswaModel::orderBy('nama_mahasiswa')->get();
        $mataKuliahs = MataKuliahModel::orderBy('nama_matkul')->get();

        $activeMenu = 'nilai';
        $breadcrumb = 'Tambah Nilai Mahasiswa';
        return view('nilaiMahasiswa.create', compact('mahasiswas', 'mataKuliahs', 'activeMenu', 'breadcrumb'));
    }

    /* ── Store ──────────────────────────────────────────────── */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_mahasiswa' => 'required',
            'id_matkul'    => 'required',
            'nilai_angka'  => 'required|numeric|min:0|max:4',
            'nilai_huruf'  => 'required|in:A,B+,B,C+,C,D,E',
        ], [
            'id_mahasiswa.required' => 'Mahasiswa wajib dipilih.',
            'id_matkul.required'    => 'Mata kuliah wajib dipilih.',
            'nilai_angka.required'  => 'Nilai angka wajib diisi.',
            'nilai_angka.min'       => 'Nilai angka minimal 0.',
            'nilai_angka.max'       => 'Nilai angka maksimal 4.',
            'nilai_huruf.required'  => 'Nilai huruf wajib dipilih.',
            'nilai_huruf.in'        => 'Nilai huruf tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        // Auto-generate ID: NL0001, NL0002, ...
        $last = NilaiModel::orderByDesc('id_nilai')->first();
        if ($last) {
            $num    = (int) substr($last->id_nilai, 2) + 1;
            $newId  = 'NL' . str_pad($num, 4, '0', STR_PAD_LEFT);
        } else {
            $newId = 'NL0001';
        }

        NilaiModel::create([
            'id_nilai'     => $newId,
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_matkul'    => $request->id_matkul,
            'nilai_angka'  => $request->nilai_angka,
            'nilai_huruf'  => $request->nilai_huruf,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Data nilai berhasil ditambahkan.',
        ]);
    }

    /* ── Show (modal detail) ────────────────────────────────── */
    public function show(string $id)
    {
        $nilai       = NilaiModel::with(['mahasiswa', 'mataKuliah'])->where('id_nilai', $id)->firstOrFail();
        $mahasiswas  = MahasiswaModel::orderBy('nama_mahasiswa')->get();
        $mataKuliahs = MataKuliahModel::orderBy('nama_matkul')->get();

        $activeMenu = 'nilai';
        $breadcrumb = 'Detail Nilai Mahasiswa';
        return view('nilaiMahasiswa.show', compact('nilai', 'mahasiswas', 'mataKuliahs', 'activeMenu', 'breadcrumb'));
    }

    /* ── Edit (modal form) ──────────────────────────────────── */
    public function edit(string $id)
    {
        $nilai       = NilaiModel::with(['mahasiswa', 'mataKuliah'])->where('id_nilai', $id)->firstOrFail();
        $mahasiswas  = MahasiswaModel::orderBy('nama_mahasiswa')->get();
        $mataKuliahs = MataKuliahModel::orderBy('nama_matkul')->get();

        $activeMenu = 'nilai';
        $breadcrumb = 'Edit Nilai Mahasiswa';
        return view('nilaiMahasiswa.edit', compact('nilai', 'mahasiswas', 'mataKuliahs', 'activeMenu', 'breadcrumb'));
    }

    /* ── Update ─────────────────────────────────────────────── */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_mahasiswa' => 'required',
            'id_matkul'    => 'required',
            'nilai_angka'  => 'required|numeric|min:0|max:4',
            'nilai_huruf'  => 'required|in:A,B+,B,C+,C,D,E',
        ], [
            'id_mahasiswa.required' => 'Mahasiswa wajib dipilih.',
            'id_matkul.required'    => 'Mata kuliah wajib dipilih.',
            'nilai_angka.required'  => 'Nilai angka wajib diisi.',
            'nilai_angka.min'       => 'Nilai angka minimal 0.',
            'nilai_angka.max'       => 'Nilai angka maksimal 4.',
            'nilai_huruf.required'  => 'Nilai huruf wajib dipilih.',
            'nilai_huruf.in'        => 'Nilai huruf tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $nilai = NilaiModel::where('id_nilai', $id)->firstOrFail();
        $nilai->update([
            'id_mahasiswa' => $request->id_mahasiswa,
            'id_matkul'    => $request->id_matkul,
            'nilai_angka'  => $request->nilai_angka,
            'nilai_huruf'  => $request->nilai_huruf,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Data nilai berhasil diperbarui.',
        ]);
    }

    /* ── Delete (modal konfirmasi) ──────────────────────────── */
    public function delete(string $id)
    {
        $nilai       = NilaiModel::with(['mahasiswa', 'mataKuliah'])->where('id_nilai', $id)->firstOrFail();
        $mahasiswas  = collect();
        $mataKuliahs = collect();

        $activeMenu = 'nilai';
        $breadcrumb = 'Hapus Nilai Mahasiswa';
        return view('nilaiMahasiswa.delete', compact('nilai', 'mahasiswas', 'mataKuliahs', 'activeMenu', 'breadcrumb'));
    }

    /* ── Destroy ────────────────────────────────────────────── */
    public function destroy(string $id)
    {
        $nilai = NilaiModel::where('id_nilai', $id)->firstOrFail();
        $nilai->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Data nilai berhasil dihapus.',
        ]);
    }
}