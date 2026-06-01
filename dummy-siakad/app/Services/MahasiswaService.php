<?php

namespace App\Services;

use App\Models\MahasiswaModel;

class MahasiswaService
{
    public function getMahasiswa(string $nim): ?array
    {
        $mahasiswa = MahasiswaModel::with([
            'nilai.mataKuliah',
            'programStudi'
        ])
            ->where('nim', $nim)
            ->first();

        if (!$mahasiswa) {
            return null;
        }

        $keahlian = $this->getKeahlianKombinasi($mahasiswa);

        return [
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama_mahasiswa,
            'email' => $mahasiswa->email,
            'program_studi' => $mahasiswa->programStudi?->nama_prodi,
            'ipk' => $this->hitungIPK($mahasiswa),
            'keahlian' => implode(', ', $keahlian),
        ];
    }

    private function hitungIPK($mahasiswa): float
    {
        $nilai = $mahasiswa->nilai;

        if ($nilai->isEmpty()) {
            return 0.00;
        }

        $totalNilai = $nilai->sum('nilai_angka');
        $jumlahMatkul = $nilai->count();

        return round($totalNilai / $jumlahMatkul, 2);
    }

    private function getKeahlianKombinasi($mahasiswa): array
    {
        $keahlianList = [];

        foreach ($mahasiswa->nilai as $nilai) {

            if (!in_array($nilai->nilai_huruf, ['A', 'B+', 'B'])) {
                continue;
            }

            if (!$nilai->mataKuliah) {
                continue;
            }

            $skills = array_map(
                'trim',
                explode(',', $nilai->mataKuliah->keahlian)
            );

            foreach ($skills as $skill) {

                if (
                    !empty($skill)
                    && !in_array($skill, $keahlianList)
                ) {
                    $keahlianList[] = $skill;
                }
            }
        }

        sort($keahlianList);

        return $keahlianList;
    }
}
