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
        Schema::create('mata_kuliah_models', function (Blueprint $table) {
            $table->string('id_matkul')->primary();
            $table->string('prodi_id');
            $table->string('nama_matkul');
            $table->string('keahlian');
            $table->string('tools');
            $table->timestamps();

            $table->foreign('prodi_id')->references('prodi_id')->on('program_studi_models')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah_models');
    }
};
