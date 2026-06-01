<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use App\Services\MahasiswaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    protected MahasiswaService $mahasiswaService;

    public function __construct(MahasiswaService $mahasiswaService)
    {
        $this->mahasiswaService = $mahasiswaService;
    }

    public function cariByNim(Request $request, $nim)
    {
        $validator = Validator::make(
            ['nim' => $nim],
            ['nim' => ['required', 'string', 'digits_between:6,10']]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'NIM tidak valid',
                'data' => null,
            ], 422);
        }

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
