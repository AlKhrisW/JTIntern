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
        Schema::create('lowongan_models', function (Blueprint $table) {
            $table->string('lowongan_id')->primary();

            // foreign key ke perusahaan_models
            $table->string('perusahaan_id');

            $table->foreign('perusahaan_id')
                ->references('perusahaan_id')
                ->on('perusahaan_models')
                ->onDelete('cascade');

            $table->string('posisi');
            $table->text('deskripsi');

            $table->text('tools')->nullable();
            $table->text('skill')->nullable();

            $table->float('ipk_min')->nullable();

            $table->integer('periode')->nullable();
            $table->string('insentif')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_models');
    }
};