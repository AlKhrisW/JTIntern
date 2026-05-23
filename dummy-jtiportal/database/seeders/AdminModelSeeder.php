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
        DB::table('admin_models')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'nama_lengkap' => 'Administrator JTIntern',
            'photo_profile' => null,
            'email' => 'admin@jtintern.com',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}