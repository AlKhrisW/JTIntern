<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DetailResource;
use App\Services\DetailService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    protected DetailService $detailService;

    public function __construct(DetailService $detailService)
    {
        $this->detailService = $detailService;
    }

    public function detail(Request $request, $id)
    {
        $validator = Validator::make(
            ['lowongan_id' => $id],
            ['lowongan_id' => ['required', 'string']]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'ID Lowongan tidak valid',
                'data' => null,
            ], 422);
        }

        $lowongan = $this->detailService->getLowonganDetail($id);

        if (!$lowongan) {
            return response()->json([
                'success' => false,
                'message' => 'Data lowongan beserta perusahaan tidak ditemukan',
                'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail lowongan berhasil diambil',
            'data' => new DetailResource($lowongan),
        ]);
    }
}
