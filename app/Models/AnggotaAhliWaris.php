<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaAhliWaris extends Model
{
    use HasFactory;
    protected $table = 'anggota_ahliwaris';

    protected $fillable = [
        'surat_penduduk_id', 'nama', 'nik', 'tempat_lahir', 'tgl_lahir', 'jk',
    ];

    // Relasi
    public function suratPenduduk()
    {
        return $this->belongsTo(SuratPenduduk::class);
    }
}
