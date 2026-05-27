<?php

namespace App\Http\Controllers;

use App\Models\ProgramStudiModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ProgramStudiModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = (object) [
            'title' => 'Daftar program studi yang terdaftar dalam sistem'
        ];

        $activeMenu = 'programstudi';

        return view('programStudi.index', [
            'breadcrumb' => 'Daftar Program Studi',
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $programStudis = ProgramStudiModel::select('prodi_id', 'nama_prodi');

        return DataTables::of($programStudis)
            // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($programStudis) { // menambahkan kolom aksi
                $btn = '<button onclick="modalAction(\''.url('/programstudi/' . $programStudis->prodi_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/programstudi/' . $programStudis->prodi_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(ProgramStudiModel $programStudiModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudiModel $programStudiModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramStudiModel $programStudiModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudiModel $programStudiModel)
    {
        //
    }
}
