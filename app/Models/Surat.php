<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_surat',
        'nama_surat',
        'jenis_surat',
    ];

    // Relasi
    public function detailSurats()
    {
        return $this->hasMany(DetailSurat::class, 'surat_penduduk_id');
    }

    public function suratPenduduks()
    {
        return $this->hasMany(SuratPenduduk::class);
    }
}
