<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa_models', function (Blueprint $table) {
            $table->string('nim')->primary();
            $table->string('nama_mahasiswa');
            $table->string('email')->unique();
            $table->string('prodi_id');
            $table->timestamps();
 
            $table->foreign('prodi_id')
                  ->references('prodi_id')
                  ->on('program_studi_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_models');
    }
};
