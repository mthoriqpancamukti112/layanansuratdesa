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
        Schema::create('detail_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_penduduk_id')->constrained('surat_penduduks')->onDelete('cascade');

            // Detail untuk Surat Usaha
            $table->string('bidang_usaha')->nullable();
            $table->date('berjalan_sejak')->nullable();
            $table->text('alamat_usaha')->nullable();
            $table->string('nama_usaha_skusaha')->nullable();

            // Detail untuk Surat Tidak Mampu
            $table->text('keperluan_tidakmampu')->nullable();
            $table->string('upload_kk')->nullable();
            $table->string('upload_ktp')->nullable();

            // Detail untuk Surat Pindah
            $table->enum('alasan_pindah', ['Pekerjaan', 'Pendidikan', 'Keamanan', 'Kesehatan', 'Perumahan', 'Keluarga', 'Pindah Tempat Tinggal'])->nullable();
            $table->text('alamat_tujuan_pindah')->nullable();
            $table->string('nama_desa_pindah', 255)->nullable();
            $table->string('kecamatan_pindah', 255)->nullable();
            $table->string('kabupaten_pindah', 255)->nullable();
            $table->string('provinsi_pindah', 255)->nullable();
            $table->string('no_telp')->nullable()->nullable();
            $table->integer('kode_pos')->nullable();
            $table->integer('rt')->nullable();
            $table->integer('rw')->nullable();
            $table->enum('klasifikasi_pindah', ['Dalam Satu Desa/Kelurahan', 'Antar Desa/Kelurahan', 'Antar Kecamatan', 'Antar Kab/Kota', 'Antar Provinsi'])->nullable();
            $table->enum('jenis_perpindahan', ['Kepala Keluarga', 'Kep. Keluarga dan Seluruh Anggota Keluarga', 'Kep. Keluarga dan Sebagian Anggota Keluarga', 'Anggota Keluarga'])->nullable();
            $table->enum('status_no_kk_tidakpindah', ['Numpang KK', 'Membuat KK baru', 'Tidak ada anggota keluarga yang ditinggal', 'Nomor KK tetap'])->nullable();
            $table->enum('status_no_kk_pindah', ['Numpang KK', 'Membuat KK baru', 'Nama Kep. keluarga dan No. KK tetap'])->nullable();
            $table->date('rencana_tgl_pindah')->nullable();

            // Detail untuk surat ahli waris
            $table->text('keperluan_ahliwaris')->nullable();

            // Detail untuk surat rekomendasibbm
            $table->string('nama_usaha_rekomendasibbm', 255)->nullable();
            $table->string('konsumen_pengguna', 255)->nullable();
            $table->string('jenis_usaha', 255)->nullable();
            $table->string('jenis_alat', 255)->nullable();
            $table->string('fungsi', 255)->nullable();
            $table->string('jumlah_alat', 50)->nullable();
            $table->string('daya_alat', 255)->nullable();
            $table->string('lama_penggunaan', 255)->nullable();
            $table->string('lama_operasi_alat', 255)->nullable();
            $table->string('konsumsi', 255)->nullable();
            $table->string('alat_pembelian_digunakan', 255)->nullable();

            // Detail untuk surat tanah
            $table->string('dusun', 255)->nullable();
            $table->string('nama_desa_sktanah', 255)->nullable();
            $table->string('kecamatan_sktanah', 255)->nullable();
            $table->string('kabupaten_sktanah', 255)->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('status_tanah', 255)->nullable();
            $table->string('digunakan_untuk', 255)->nullable();
            $table->string('cara_memperoleh', 255)->nullable();
            $table->string('batas_utara', 255)->nullable();
            $table->string('batas_timur', 255)->nullable();
            $table->string('batas_selatan', 255)->nullable();
            $table->string('batas_barat', 255)->nullable();
            $table->text('keperluan_sktanah')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_surats');
    }
};
