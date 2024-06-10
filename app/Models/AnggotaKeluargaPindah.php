<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluargaPindah extends Model
{
    use HasFactory;
    protected $table = 'anggota_keluarga_pindahs';


    protected $fillable = [
        'surat_penduduk_id', 'nik', 'nama', 'shdk',
    ];

    // Relasi
    public function suratPenduduk()
    {
        return $this->belongsTo(SuratPenduduk::class);
    }
}
