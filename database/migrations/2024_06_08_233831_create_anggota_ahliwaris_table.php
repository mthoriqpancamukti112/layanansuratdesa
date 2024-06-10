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
        Schema::create('anggota_ahliwaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_penduduk_id')->constrained('surat_penduduks')->onDelete('cascade');
            $table->string('nama', 255);
            $table->string('nik', 16);
            $table->string('tempat_lahir', 255);
            $table->date('tgl_lahir');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_ahliwaris');
    }
};
