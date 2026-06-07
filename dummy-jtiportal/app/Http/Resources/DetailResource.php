<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'lowongan_id' => $this['lowongan_id'],
            'perusahaan'  => $this['perusahaan'],
            'posisi'      => $this['posisi'],
            'deskripsi'   => $this['deskripsi'],
            'kualifikasi' => [
                'ipk_min' => $this['ipk_min'],
                'tools'   => $this['tools'],
                'skill'   => $this['skill'],
            ],
            'detail' => [
                'periode'  => $this['periode'],
                'insentif' => $this['insentif'],
            ]
        ];
    }
}
