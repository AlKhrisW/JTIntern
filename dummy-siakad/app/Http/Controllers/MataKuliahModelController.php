<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudiModel;
use App\Models\MataKuliahModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MataKuliahModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MataKuliahModel::with('programStudi')->orderBy('nama_matkul');

        // FILTER PROGRAM STUDI
        if ($request->filled('prodi_id')) {
            $query->where('prodi_id', $request->prodi_id);
        }

        // SEARCH
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where(function ($q) use ($keyword) {
                $q->where('id_matkul', 'like', '%' . $keyword . '%')
                  ->orWhere('nama_matkul', 'like', '%' . $keyword . '%')
                  ->orWhere('keahlian', 'like', '%' . $keyword . '%');
            });
        }

        $mataKuliahs = $query->paginate(10)->withQueryString();
        $programStudis = ProgramStudiModel::orderBy('nama_prodi')->get();

        return view('mataKuliah.index', [
            'activeMenu'     => 'mataKuliah',
            'breadcrumb'     => 'Mata Kuliah',
            'title'          => 'JTIntern - Manajemen Mata Kuliah',
            'mataKuliahs'    => $mataKuliahs,
            'programStudis'  => $programStudis,
            'totalMataKuliah'=> MataKuliahModel::count(),
        ]);
    }

    public function list(Request $request)
    {
        $query = MataKuliahModel::with('programStudi')->select('*');

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
        return view('mataKuliah.create', compact('programStudis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_matkul'   => 'required|string|unique:mata_kuliah_models,id_matkul',
            'prodi_id'    => 'required|exists:program_studi_models,prodi_id',
            'nama_matkul' => 'required|string|max:255',
            'keahlian'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        MataKuliahModel::create($request->only(['id_matkul', 'prodi_id', 'nama_matkul', 'keahlian']));

        return response()->json([
            'status'  => true,
            'message' => 'Mata Kuliah berhasil ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $mataKuliah = MataKuliahModel::with('programStudi')->findOrFail($id);
        return view('mataKuliah.show', compact('mataKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mataKuliah = MataKuliahModel::findOrFail($id);
        $programStudis = ProgramStudiModel::orderBy('nama_prodi')->get();
        return view('mataKuliah.edit', compact('mataKuliah', 'programStudis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mataKuliah = MataKuliahModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_matkul' => 'required|string|max:255',
            'prodi_id'    => 'required|exists:program_studi_models,prodi_id',
            'keahlian'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $mataKuliah->update($request->only(['nama_matkul', 'prodi_id', 'keahlian']));

        return response()->json([
            'status'  => true,
            'message' => 'Mata Kuliah berhasil diperbarui.',
        ]);
    }

    public function delete($id)
    {
        $mataKuliah = MataKuliahModel::with('programStudi')->findOrFail($id);
        return view('mataKuliah.delete', compact('mataKuliah'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $mataKuliah = MataKuliahModel::findOrFail($id);
            $mataKuliah->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Mata Kuliah berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage(),
            ], 500);
        }
    }
}
