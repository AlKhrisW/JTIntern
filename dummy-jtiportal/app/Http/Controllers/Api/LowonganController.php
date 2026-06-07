<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LowonganResource;
use App\Services\LowonganService;
use Illuminate\Http\JsonResponse;

class LowonganController extends Controller
{
    protected LowonganService $lowonganService;

    public function __construct(LowonganService $lowonganService) {
        $this->lowonganService = $lowonganService;
    }

    public function index(): JsonResponse
    {
        $lowongan = $this->lowonganService
            ->getLowonganAktif();

        return response()->json([
            'success' => true,
            'message' => 'Data lowongan aktif berhasil diambil',
            'total_data' => $lowongan->count(),
            'data' => LowonganResource::collection($lowongan),
        ]);
    }
}