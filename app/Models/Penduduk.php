<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'no_kk', 'nik', 'jk', 'tempat_lahir', 'tgl_lahir',
        'kewarganegaraan', 'agama', 'status', 'pendidikan', 'pekerjaan',
        'provinsi', 'kabupaten', 'kecamatan', 'desa', 'alamat', 'no_hp',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function suratPenduduks()
    {
        return $this->hasMany(SuratPenduduk::class);
    }
}
