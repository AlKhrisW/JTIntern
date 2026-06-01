<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LowonganResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'lowongan_id' => $this->lowongan_id,
            'perusahaan_id' => $this->perusahaan_id,
            'posisi' => $this->posisi,
            'deskripsi' => $this->deskripsi,
            'tools' => $this->tools,
            'skill' => $this->skill,
            'ipk_min' => $this->ipk_min,
            'periode' => $this->periode,
            'insentif' => $this->insentif,
            'status' => $this->status,

            'perusahaan' => new PerusahaanResource(
                $this->whenLoaded('perusahaan')
            ),
        ];
    }
}