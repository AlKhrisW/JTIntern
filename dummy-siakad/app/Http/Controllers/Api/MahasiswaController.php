<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Services\MahasiswaService;

class MahasiswaController extends Controller
{
    protected MahasiswaService $mahasiswaService;

    public function __construct(MahasiswaService $mahasiswaService)
    {
        $this->mahasiswaService = $mahasiswaService;
    }

    public function cariByNim($nim)
    {
        $nim->validate([
            'nim' => ['required', 'string'],
        ]);

        $mahasiswa = $this->mahasiswaService->getMahasiswa($nim);

        if (!$mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Mahasiswa tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa ditemukan',
            'data' => new MahasiswaResource($mahasiswa),
        ]);
    }
}