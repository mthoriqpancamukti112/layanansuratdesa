<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'nama_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'alamat_kantor',
        'no_telp',
        'email',
        'kades',
        'nip_kades',
        'sekdes',
        'nip_sekdes',
        'bendahara',
    ];

    public function suratPenduduks()
    {
        return $this->hasMany(SuratPenduduk::class);
    }
}
