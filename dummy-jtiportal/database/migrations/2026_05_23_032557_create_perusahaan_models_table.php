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
        Schema::create('perusahaan_models', function (Blueprint $table) {
            $table->string('perusahaan_id')->primary();
            $table->string('nama_perusahaan');
            $table->string('jenis_perusahaan');
            $table->text('profil_perusahaan');
            $table->string('lokasi');
            $table->string('web_career')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan_models');
    }
};