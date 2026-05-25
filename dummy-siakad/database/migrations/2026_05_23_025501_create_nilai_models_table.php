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
        Schema::create('nilai_models', function (Blueprint $table) {
            $table->string('id_nilai')->primary();
            $table->string('id_mahasiswa');
            $table->string('id_matkul');
            $table->string('nilai_huruf', 2);   // A, B+, B, C+, C, D, E
            $table->decimal('nilai_angka', 4, 2); // 0.00 – 4.00
            $table->timestamps();
 
            $table->foreign('id_mahasiswa')
                  ->references('nim')
                  ->on('mahasiswa_models')
                  ->onDelete('cascade');
 
            $table->foreign('id_matkul')
                  ->references('id_matkul')
                  ->on('mata_kuliah_models')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_models');
    }
};
