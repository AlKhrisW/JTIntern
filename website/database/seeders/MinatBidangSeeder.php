<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MinatBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $minatBidang = [
            'Frontend Developer',
            'Backend Developer',
            'Fullstack Developer',
            'Web Application Developer',
            'UI/UX',
            'Android Developer',
            'Mobile App Developer',
            'Data Analyst',
            'Data Scientist',
            'Machine Learning Engineer',
            'Business Intelligence (BI) Analyst',
            'Cyber Security Analyst',
            'Network Engineer',
            'Software Engineer',
            'DevOps Engineer',
            'Cloud Engineer',
            'System Engineer',
            'IoT Developer'
        ];

        foreach ($minatBidang as $index => $bidang) {
            DB::table('minat_bidang')->insert([
                'id_minat_bidang'   => 'MB' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'nama_minat_bidang' => $bidang,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
