<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'nim' => $this['nim'],
            'nama' => $this['nama'],
            'email' => $this['email'],
            'program_studi' => $this['program_studi'],
            'ipk' => $this['ipk'],
            'keahlian' => $this['keahlian'],
            'tools' => $this['tools'],
        ];
    }
}