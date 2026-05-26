<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProgramStudiModelSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $programStudi = [
            // JTI001 - D-IV Teknik Informatika
            [
                'prodi_id'   => 'JTI001',
                'nama_prodi' => 'D-IV Teknik Informatika',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            // JTI002 - D-IV Sistem Informasi Bisnis
            [
                'prodi_id'   => 'JTI002',
                'nama_prodi' => 'D-IV Sistem Informasi Bisnis',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ];

        DB::table('program_studi_models')->insert($programStudi);
    }
}