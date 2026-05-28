<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudiModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProgramStudiModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = ProgramStudiModel::orderBy('nama_prodi');

        // SEARCH
        if ($request->filled('search')) {
            $keyword = $request->search;
            $query->where('nama_prodi', 'like', '%' . $keyword . '%');
        }

        $programStudis = $query->paginate(15)->withQueryString();

        return view('programStudi.index', [
            'activeMenu'        => 'programStudi',
            'breadcrumb'        => 'Program Studi',
            'title'             => 'JTIntern - Manajemen Program Studi',
            'programStudis'     => $programStudis,
            'totalProgramStudi' => ProgramStudiModel::count(),
        ]);
    }

    public function list(Request $request)
    {
        $query = ProgramStudiModel::all();

        if ($request->filled('search')) {
            $query->where('nama_prodi', 'like', '%' . $request->search . '%');
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
        return view('programStudi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required|string|max:255|unique:program_studi_models,nama_prodi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        ProgramStudiModel::create([
            'prodi_id'   => 'PRO' . strtoupper(substr(uniqid(), -6)),
            'nama_prodi' => $request->nama_prodi,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Program Studi berhasil ditambahkan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudiModel $programStudiModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programStudi = ProgramStudiModel::findOrFail($id);
        return view('programStudi.edit', compact('programStudi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $programStudi = ProgramStudiModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_prodi' => 'required|string|max:255|unique:program_studi_models,nama_prodi,' . $id . ',prodi_id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'   => false,
                'message'  => 'Validasi gagal.',
                'msgField' => $validator->errors(),
            ]);
        }

        $programStudi->update([
            'nama_prodi' => $request->nama_prodi,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Program Studi berhasil diperbarui.',
        ]);
    }

    public function delete($id)
    {
        $programStudi = ProgramStudiModel::findOrFail($id);
        return view('programStudi.delete', compact('programStudi'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $programStudi = ProgramStudiModel::findOrFail($id);
            $programStudi->delete();

            return response()->json([
                'status'  => true,
                'message' => 'Program Studi berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Gagal menghapus: ' . $e->getMessage(),
            ], 500);
        }
    }
}
