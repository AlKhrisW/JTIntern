<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rekomendasi', function (Blueprint $table) {
            $table->string('rekomendasi_id')->primary();

            // relasi ke profil mahasiswa
            $table->string('profil_id');

            $table->foreign('profil_id')
                ->references('mahasiswa_id')
                ->on('profil_mahasiswa')
                ->onDelete('cascade');

            // relasi ke lowongan
            $table->string('lowongan_id');

            $table->foreign('lowongan_id')
                ->references('lowongan_id')
                ->on('lowongan')
                ->onDelete('cascade');

            $table->float('skor_kecocokan')->nullable();
            $table->integer('rangking')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rekomendasi');
    }
};
