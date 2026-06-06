<?php

namespace App\Services;

use App\Models\LowonganModel;

class DetailService
{
    public function getLowonganDetail(string $lowonganId): ?array
    {
        // Memuat data lowongan sekaligus relasi perusahaannya
        $detail = LowonganModel::with('perusahaan')
            ->where('lowongan_id', $lowonganId)
            ->first();

        if (!$detail) {
            return null;
        }

        return [
            'lowongan_id' => $detail->lowongan_id,
            'posisi'      => $detail->posisi,
            'deskripsi'   => $detail->deskripsi,
            'tools'       => $detail->tools,
            'skill'       => $detail->skill,
            'ipk_min'     => $detail->ipk_min,
            'periode'     => $detail->periode,
            'insentif'    => $detail->insentif,

            // Mengambil data dari tabel perusahaan_models
            'perusahaan' => $detail->perusahaan ? [
                'perusahaan_id'    => $detail->perusahaan->perusahaan_id,
                'nama_perusahaan'  => $detail->perusahaan->nama_perusahaan,
                'jenis_perusahaan' => $detail->perusahaan->jenis_perusahaan,
                'profil_perusahaan'=> $detail->perusahaan->profil_perusahaan,
                'lokasi'           => $detail->perusahaan->lokasi,
                'web_career'       => $detail->perusahaan->web_career,
                'logo'             => $detail->perusahaan->logo,
            ] : null,
        ];
    }
}