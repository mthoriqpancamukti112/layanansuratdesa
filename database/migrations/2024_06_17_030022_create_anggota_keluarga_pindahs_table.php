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
        Schema::create('anggota_keluarga_pindahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_penduduk_id')->constrained('surat_penduduks')->onDelete('cascade');
            $table->string('nik');
            $table->string('nama');
            $table->string('shdk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluarga_pindahs');
    }
};