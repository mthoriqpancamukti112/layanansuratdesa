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
        Schema::create('desas', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('nama_desa', 255);
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->text('alamat_kantor');
            $table->string('no_telp');
            $table->string('email');
            $table->string('kades', 255);
            $table->string('nip_kades');
            $table->string('sekdes', 255);
            $table->string('nip_sekdes');
            $table->string('bendahara', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
