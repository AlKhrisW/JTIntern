<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->string('lowongan_id')->primary();

            // foreign key ke perusahaan
            $table->string('perusahaan_id');

            $table->foreign('perusahaan_id')
                ->references('perusahaan_id')
                ->on('perusahaan')
                ->onDelete('cascade');

            $table->string('posisi');
            $table->text('deskripsi'); // wajib

            $table->text('tools')->nullable();   // contoh: Laravel, Figma
            $table->text('skill')->nullable();   // contoh: communication, coding

            $table->float('ipk_min')->nullable();

            $table->integer('periode')->nullable(); //dalam bulan
            $table->string('insentif')->nullable(); // paid/unpaid

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
