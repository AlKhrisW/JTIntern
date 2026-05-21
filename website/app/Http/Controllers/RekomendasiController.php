<?php

namespace App\Http\Controllers;

use App\Models\ProfilMahasiswaModel;
use App\Models\MinatBidangModel;
use App\Models\RekomendasiModel;
use App\Models\SkillModel;
use App\Models\ToolsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekomendasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $skills = SkillModel::pluck('nama_skill')->toArray();
        $tools = ToolsModel::pluck('nama_tools')->toArray();
        $minat = MinatBidangModel::pluck('nama_minat_bidang')->toArray();

        return view('rekomendasi.index', [
            'activeMenu' => 'rekomendasi',
            'title' => 'Rekomendasi - JTIntern',
            'skills' => $skills,
            'tools' => $tools,
            'minat' => $minat,
            'savedSkills' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama'              => 'required|string|max:100',
            'email'             => 'required|email|max:100',
            'ipk'               => 'required|numeric|between:0,4',
            'jenis_perusahaan'  => 'required|string|max:100',
            'skills'            => 'required|string',           // atau 'array' jika pakai array
            'tools'             => 'required|string',
            'minat_bidang'      => 'required|string',
        ]);

        if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
        }
        ProfilMahasiswaModel::create([
            'nama'            => $request->nama,
            'email'           => $request->email,
            'ipk'             => $request->ipk,
            'jenis_perusahaan'=> $request->jenis_perusahaan,
            'skill'           => $request->skills,
            'tools'           => $request->tools,
            'minat_bidang'    => $request->minat_bidang,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RekomendasiModel $rekomendasiModel)
    {
        //
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
