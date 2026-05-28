<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class StatusLowonganSeeder extends Seeder
{
    public function run(): void
    {
        $lowongans = DB::table('lowongan_models')->get();

        foreach ($lowongans as $lowongan) {

            DB::table('lowongan_models')
                ->where('lowongan_id', $lowongan->lowongan_id)
                ->update([
                    'status' => Arr::random([
                        'Aktif',
                        'Selesai'
                    ])
                ]);
        }
    }
}
