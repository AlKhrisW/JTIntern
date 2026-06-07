<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerusahaanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'perusahaan_id' => $this->perusahaan_id,
            'nama_perusahaan' => $this->nama_perusahaan,
            'jenis_perusahaan' => $this->jenis_perusahaan,
            'profil_perusahaan' => $this->profil_perusahaan,
            'lokasi' => $this->lokasi,
            'web_career' => $this->web_career,
        ];
    }
}