<?php

namespace App\Services;

use App\Models\LowonganModel;

class LowonganService
{
    public function getLowonganAktif()
    {
        return LowonganModel::with('perusahaan')
            ->where('status', 'aktif')
            ->get();
    }
}