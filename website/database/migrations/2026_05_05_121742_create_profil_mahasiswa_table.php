<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_mahasiswa', function (Blueprint $table) {
            $table->string('mahasiswa_id')->primary();

            $table->string('nama');
            $table->string('email')->unique();
            $table->float('ipk', 3, 2);
            $table->string('jenis_perusahaan');

            $table->text('tools');
            $table->text('skill');
            $table->string('minat_bidang');


            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_mahasiswa');
    }
};
