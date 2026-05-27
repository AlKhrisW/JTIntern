<?php

namespace App\Http\Controllers;

use App\Models\LowonganModel;
use App\Models\PerusahaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LowonganModelController extends Controller
{
    public function index(Request $request)
    {
        $query = LowonganModel::with('perusahaan')->orderBy('created_at', 'desc');

        // FILTER BERDASARKAN PERUSAHAAN
        if ($request->filled('perusahaan')) {
            $query->where('perusahaan_id', $request->perusahaan);
        }
        $perusahaans = PerusahaanModel::orderBy('nama_perusahaan')->get();

        // FILTER BERDASARKAN STATUS
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // UNTUK PAGE
        $lowongans = $query->paginate(10)->withQueryString();

        $totalLowongan = LowonganModel::count();
        $totalLowonganAktif = LowonganModel::where('status', 'Aktif')->count();
        $totalLowonganSelesai = LowonganModel::where('status', 'Selesai')->count();

        return view('admin_lowongan.index', [
            'activeMenu' => 'lowongan',
            'breadcrumb' => 'Lowongan',
            'title'      => 'JTIntern - Sistem Rekomendasi Tempat Magang',
            'lowongans'  => $lowongans,
            'totalLowongan' => $totalLowongan,
            'totalLowonganAktif' => $totalLowonganAktif,
            'totalLowonganSelesai' => $totalLowonganSelesai
        ], compact('perusahaans'));
    }

    public function list(Request $request)
    {
        $query = LowonganModel::with('perusahaan')->select('*');

        if ($request->filled('perusahaan')) {
            $query->where('perusahaan_id', $request->perusahaan);
        }

        if ($request->filled('periode')) {
            $query->where('periode', $request->periode);
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
        $perusahaans = PerusahaanModel::orderBy('nama_perusahaan')->get();

        return view('admin_lowongan.create_ajax', compact('perusahaans'));
    }

    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perusahaan_id' => 'required|exists:perusahaan_models,perusahaan_id',
            'posisi'        => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'tools'         => 'required|string',
            'skill'         => 'required|string',
            'ipk_min'       => 'required|numeric|min:0|max:4',
            'periode'       => 'required|integer|min:1',
            'insentif'      => 'required|string|max:255',
            'status'         => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        LowonganModel::create([
            'perusahaan_id' => $request->perusahaan_id,
            'posisi'        => $request->posisi,
            'deskripsi'     => $request->deskripsi,
            'tools'         => $request->tools,
            'skill'         => $request->skill,
            'ipk_min'       => $request->ipk_min,
            'periode'       => $request->periode,
            'insentif'      => $request->insentif,
            'status'        => $request->status
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
            'perusahaan_id' => 'required|exists:perusahaan_models,perusahaan_id',
            'posisi'        => 'required|string|max:255',
            'deskripsi'     => 'required|string',
            'tools'         => 'required|string',
            'skill'         => 'required|string',
            'ipk_min'       => 'required|numeric|min:0|max:4',
            'periode'       => 'required|integer|min:1',
            'insentif'      => 'required|string|max:255',
            'status'         => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $lowongan->update([
            'perusahaan_id' => $request->perusahaan_id,
            'posisi'        => $request->posisi,
            'deskripsi'     => $request->deskripsi,
            'tools'         => $request->tools,
            'skill'         => $request->skill,
            'ipk_min'       => $request->ipk_min,
            'periode'       => $request->periode,
            'insentif'      => $request->insentif,
            'status'        => $request->status,
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
            ], 500);
        }
    }
}
