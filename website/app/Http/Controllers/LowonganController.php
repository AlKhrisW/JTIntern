<?php

namespace App\Http\Controllers;

use App\Models\LowonganModel;
use App\Models\PerusahaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LowonganController extends Controller
{
    public function index(Request $request)
    {
        $query = LowonganModel::with('perusahaan')
            ->orderBy('created_at', 'desc');

        // FILTER
        if ($request->filled('perusahaan')) {
            $query->where('perusahaan_id', $request->perusahaan);
        }

        // SEARCH GLOBAL
        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($q) use ($keyword) {
                $q->where('judul_lowongan', 'like', '%' . $keyword . '%')
                    ->orWhere('posisi', 'like', '%' . $keyword . '%')
                    ->orWhere('lokasi', 'like', '%' . $keyword . '%')
                    ->orWhere('tipe_pekerjaan', 'like', '%' . $keyword . '%');
            });
        }

        $lowongans = $query->paginate(10)->withQueryString();
        $perusahaans = PerusahaanModel::orderBy('nama_perusahaan')->get();

        $totalLowongan = LowonganModel::count();

        return view('admin_lowongan.index', [
            'activeMenu' => 'lowongan',
            'breadcrumb' => 'Lowongan',
            'title'      => 'JTIntern - Sistem Rekomendasi Tempat Magang',
            'lowongans'  => $lowongans,
            'totalLowongan' => $totalLowongan,
        ], compact('perusahaans'));
    }

    public function list(Request $request)
    {
        $query = LowonganModel::with('perusahaan')->select('*');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function show_ajax($id)
    {
        $lowongan = LowonganModel::with('perusahaan')->findOrFail($id);

        return view('admin_lowongan.show_ajax', compact('lowongan'));
    }

    public function create_ajax()
    {
        $perusahaans = PerusahaanModel::all();

        return view('admin_lowongan.create_ajax', compact('perusahaans'));
    }

    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perusahaan_id'      => 'required',
            'judul_lowongan'     => 'required|string|max:255',
            'deskripsi_lowongan' => 'required|string',
            'posisi'             => 'required|string|max:255',
            'tipe_pekerjaan'     => 'required|string|max:255',
            'lokasi'             => 'required|string|max:255',
            'salary'             => 'nullable|string|max:255',
            'deadline'           => 'required|date',
            'status'             => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        LowonganModel::create([
            'perusahaan_id'      => $request->perusahaan_id,
            'judul_lowongan'     => $request->judul_lowongan,
            'deskripsi_lowongan' => $request->deskripsi_lowongan,
            'posisi'             => $request->posisi,
            'tipe_pekerjaan'     => $request->tipe_pekerjaan,
            'lokasi'             => $request->lokasi,
            'salary'             => $request->salary,
            'deadline'           => $request->deadline,
            'status'             => $request->status,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Lowongan berhasil ditambahkan.',
        ]);
    }

    public function edit_ajax($id)
    {
        $lowongan    = LowonganModel::findOrFail($id);
        $perusahaans = PerusahaanModel::all();

        return view('admin_lowongan.edit_ajax', compact('lowongan', 'perusahaans'));
    }

    public function update_ajax(Request $request, $id)
    {
        $lowongan = LowonganModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'perusahaan_id'      => 'required',
            'judul_lowongan'     => 'required|string|max:255',
            'deskripsi_lowongan' => 'required|string',
            'posisi'             => 'required|string|max:255',
            'tipe_pekerjaan'     => 'required|string|max:255',
            'lokasi'             => 'required|string|max:255',
            'salary'             => 'nullable|string|max:255',
            'deadline'           => 'required|date',
            'status'             => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $lowongan->update([
            'perusahaan_id'      => $request->perusahaan_id,
            'judul_lowongan'     => $request->judul_lowongan,
            'deskripsi_lowongan' => $request->deskripsi_lowongan,
            'posisi'             => $request->posisi,
            'tipe_pekerjaan'     => $request->tipe_pekerjaan,
            'lokasi'             => $request->lokasi,
            'salary'             => $request->salary,
            'deadline'           => $request->deadline,
            'status'             => $request->status,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Lowongan berhasil diperbarui.',
        ]);
    }

    public function delete_ajax($id)
    {
        $lowongan = LowonganModel::with('perusahaan')->findOrFail($id);

        return view('admin_lowongan.delete_ajax', compact('lowongan'));
    }

    public function destroy_ajax($id)
    {
        try {
            $lowongan = LowonganModel::findOrFail($id);

            $lowongan->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Lowongan berhasil dihapus.',
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage(),
            ]);
        }
    }
}
