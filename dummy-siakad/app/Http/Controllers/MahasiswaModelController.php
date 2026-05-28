<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudiModel;
use App\Models\MahasiswaModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MahasiswaModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MahasiswaModel::with('programStudi')->orderBy('nama_mahasiswa');

        // FILTER PROGRAM STUDI
        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        // SEARCH
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('nim', 'like', '%' . $keyword . '%')
                  ->orWhere('nama_mahasiswa', 'like', '%' . $keyword . '%')
                  ->orWhere('email', 'like', '%' . $keyword . '%');
            });
        }

        $mahasiswas = $query->paginate(10)->withQueryString();
        $programStudis = ProgramStudiModel::orderBy('nama_prodi')->get();

        return view('mahasiswa.index', [
            'activeMenu'     => 'mahasiswa',
            'breadcrumb'     => 'Mahasiswa',
            'title'          => 'JTIntern - Manajemen Mahasiswa',
            'mahasiswas'     => $mahasiswas,
            'programStudis'  => $programStudis,
            'totalMahasiswa' => MahasiswaModel::count(),
        ]);
    }

    public function list(Request $request)
    {
        $query = MahasiswaModel::with('programStudi')->select('*');

        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programStudis = ProgramStudiModel::orderBy('nama_prodi')->get();
        return view('mahasiswa.create', compact('programStudis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim'            => 'required|string|unique:mahasiswa_models,nim',
            'nama_mahasiswa' => 'required|string|max:255',
            'email'          => 'required|email|unique:mahasiswa_models,email',
            'prodi_id'       => 'required|exists:program_studi_models,prodi_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        MahasiswaModel::create($request->only(['nim', 'nama_mahasiswa', 'email', 'prodi_id']));

        return response()->json([
            'status'  => true,
            'message' => 'Mahasiswa berhasil ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mahasiswa = MahasiswaModel::with('programStudi')->findOrFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);
        $programStudis = ProgramStudiModel::orderBy('nama_prodi')->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'programStudis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = MahasiswaModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_mahasiswa' => 'required|string|max:255',
            'email'          => 'required|email|unique:mahasiswa_models,email,' . $id . ',nim',
            'prodi_id'       => 'required|exists:program_studi_models,prodi_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $mahasiswa->update($request->only(['nama_mahasiswa', 'email', 'prodi_id']));

        return response()->json([
            'status'  => true,
            'message' => 'Mahasiswa berhasil diperbarui.',
        ]);
    }

    public function delete($id)
    {
        $mahasiswa = MahasiswaModel::with('programStudi')->findOrFail($id);
        return view('mahasiswa.delete', compact('mahasiswa'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $mahasiswa = MahasiswaModel::findOrFail($id);
            $mahasiswa->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Mahasiswa berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage(),
            ], 500);
        }
    }
}
