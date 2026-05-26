<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminModelSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('admin_models')->insert([
            'username'     => 'adminsiakad',
            'password'     => Hash::make('adminsiakad123'),
            'nama'         => 'Administrator SIAKAD',
            'email'        => 'admin@siakad.com',
            'created_at'   => Carbon::now(),
            'updated_at'   => Carbon::now(),
        ]);
    }
}