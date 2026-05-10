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
            $table->float('ipk')->nullable();

            $table->text('tools')->nullable();
            $table->text('skill')->nullable();

            $table->string('minat_bidang')->nullable();
            $table->string('preferensi_magang')->nullable();

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_mahasiswa');
    }
};
