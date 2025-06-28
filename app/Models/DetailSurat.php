<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSurat extends Model
{
    use HasFactory;
    protected $fillable = [
        'surat_penduduk_id', 'bidang_usaha', 'berjalan_sejak', 'alamat_usaha',
        'nama_usaha_skusaha', 'keperluan_tidakmampu', 'upload_kk', 'upload_ktp',
        'alasan_pindah', 'alamat_tujuan_pindah', 'nama_desa_pindah', 'kecamatan_pindah',
        'kabupaten_pindah', 'provinsi_pindah', 'no_telp', 'kode_pos', 'rt', 'rw',
        'klasifikasi_pindah', 'jenis_perpindahan', 'status_no_kk_tidakpindah',
        'status_no_kk_pindah', 'rencana_tgl_pindah', 'keperluan_ahliwaris',
        'nama_usaha_rekomendasibbm', 'konsumen_pengguna', 'jenis_usaha', 'jenis_alat',
        'fungsi', 'jumlah_alat', 'daya_alat', 'lama_penggunaan', 'lama_operasi_alat',
        'konsumsi', 'alat_pembelian_digunakan', 'dusun', 'nama_desa_sktanah',
        'kecamatan_sktanah', 'kabupaten_sktanah', 'luas_tanah', 'status_tanah',
        'digunakan_untuk', 'cara_memperoleh', 'batas_utara', 'batas_timur',
        'batas_selatan', 'batas_barat', 'keperluan_sktanah', 'jumlah_penghasilan', 'keperluan',
    ];

    // Relasi
    public function suratPenduduk()
    {
        return $this->belongsTo(SuratPenduduk::class);
    }
}
