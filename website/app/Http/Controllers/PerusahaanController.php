<?php

namespace App\Http\Controllers;

use App\Models\PerusahaanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class PerusahaanController extends Controller
{
    public function index(Request $request)
    {
        $query = PerusahaanModel::orderBy('created_at', 'desc');

        if ($request->filled('jenis')) {
            $query->where('jenis_perusahaan', $request->jenis);
        }

        $perusahaans     = $query->paginate(10)->withQueryString();
        $totalPerusahaan = PerusahaanModel::where('jenis_perusahaan', '!=', 'instansi pendidikan')->count();
        $totalInstansi   = PerusahaanModel::where('jenis_perusahaan', 'instansi pendidikan')->count();

        return view('admin_perusahaan.index', [
            'activeMenu'      => 'perusahaan',
            'breadcrumb'      => 'Perusahaan',
            'title'           => 'JTIntern - Sistem Rekomendasi Tempat Magang',
            'perusahaans'     => $perusahaans,
            'totalPerusahaan' => $totalPerusahaan,
            'totalInstansi'   => $totalInstansi,
        ]);
    }

    public function list(Request $request)
    {
        $query = PerusahaanModel::select('*');

        if ($request->filled('jenis')) {
            $query->where('jenis_perusahaan', $request->jenis);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    public function show_ajax($id)
    {
        $perusahaan = PerusahaanModel::findOrFail($id);
        return view('admin_perusahaan.show_ajax', compact('perusahaan'));
    }

    public function create_ajax()
    {
        return view('admin_perusahaan.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_perusahaan'   => 'required|string|max:255',
            'jenis_perusahaan'  => 'required|string|max:255',
            'profil_perusahaan' => 'required|string',
            'lokasi'            => 'required|string|max:255',
            'web_career'        => 'nullable|url|max:255',
            'logo'              => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ], [
            'nama_perusahaan.required'   => 'Nama perusahaan wajib diisi.',
            'jenis_perusahaan.required'  => 'Jenis perusahaan wajib diisi.',
            'profil_perusahaan.required' => 'Profil perusahaan wajib diisi.',
            'lokasi.required'            => 'Lokasi wajib diisi.',
            'web_career.url'             => 'Format URL tidak valid.',
            'logo.image'                 => 'File harus berupa gambar.',
            'logo.max'                   => 'Ukuran logo maksimal 2MB.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos/perusahaan', 'public');
        }

        PerusahaanModel::create([
            'nama_perusahaan'   => $request->nama_perusahaan,
            'jenis_perusahaan'  => $request->jenis_perusahaan,
            'profil_perusahaan' => $request->profil_perusahaan,
            'lokasi'            => $request->lokasi,
            'web_career'        => $request->web_career,
            'logo'              => $logoPath,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Perusahaan berhasil ditambahkan.',
        ]);
    }

    public function edit_ajax($id)
    {
        $perusahaan = PerusahaanModel::findOrFail($id);
        return view('admin_perusahaan.edit_ajax', compact('perusahaan'));
    }

    public function update_ajax(Request $request, $id)
    {
        $perusahaan = PerusahaanModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_perusahaan'   => 'required|string|max:255',
            'jenis_perusahaan'  => 'required|string|max:255',
            'profil_perusahaan' => 'required|string',
            'lokasi'            => 'required|string|max:255',
            'web_career'        => 'nullable|url|max:255',
            'logo'              => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $logoPath = $perusahaan->logo;
        if ($request->hasFile('logo')) {
            if ($logoPath) {
                Storage::disk('public')->delete($logoPath);
            }
            $logoPath = $request->file('logo')->store('logos/perusahaan', 'public');
        }

        $perusahaan->update([
            'nama_perusahaan'   => $request->nama_perusahaan,
            'jenis_perusahaan'  => $request->jenis_perusahaan,
            'profil_perusahaan' => $request->profil_perusahaan,
            'lokasi'            => $request->lokasi,
            'web_career'        => $request->web_career,
            'logo'              => $logoPath,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Perusahaan berhasil diperbarui.',
        ]);
    }

    public function delete_ajax(Request $request, $id)
    {
        $perusahaan = PerusahaanModel::findOrFail($id);
        return view('admin_perusahaan.delete_ajax', compact('perusahaan'));
    }

    public function destroy_ajax(Request $request, $id)
    {
        try {
            $perusahaan = PerusahaanModel::findOrFail($id);

            if ($perusahaan->logo) {
                Storage::disk('public')->delete($perusahaan->logo);
            }

            $perusahaan->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Perusahaan berhasil dihapus.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage(),
            ]);
        }
    }
}