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

        $keahlian = $this->getKombinasiKolom($mahasiswa, 'keahlian');
        $tools = $this->getKombinasiKolom($mahasiswa, 'tools');

        return [
            'nim' => $mahasiswa->nim,
            'nama' => $mahasiswa->nama_mahasiswa,
            'email' => $mahasiswa->email,
            'program_studi' => $mahasiswa->programStudi?->nama_prodi,
            'ipk' => $this->hitungIPK($mahasiswa),
            'keahlian' => $keahlian,
            'tools' => $tools,
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

    private function getKombinasiKolom($mahasiswa, string $namaKolom): array
    {
        $dataList = [];

        foreach ($mahasiswa->nilai as $nilai) {
            if (!in_array($nilai->nilai_huruf, ['A', 'B+', 'B'])) {
                continue;
            }

            if (!$nilai->mataKuliah || empty($nilai->mataKuliah->$namaKolom)) {
                continue;
            }

            $items = array_map(
                'trim',
                explode(',', $nilai->mataKuliah->$namaKolom)
            );

            foreach ($items as $item) {
                if (!empty($item) && $item !== '-' && !in_array($item, $dataList)) {
                    $dataList[] = $item;
                }
            }
        }

        sort($dataList);

        return $dataList;
    }
}
