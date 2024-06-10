<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nik', 'no_kk', 'username', 'jk', 'tempat_lahir', 'tgl_lahir',
        'kewarganegaraan', 'agama', 'status', 'pendidikan', 'pekerjaan',
        'provinsi', 'kabupaten', 'kecamatan', 'alamat', 'no_hp', 'desa',
        'tgl_buat', 'last_login',
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
