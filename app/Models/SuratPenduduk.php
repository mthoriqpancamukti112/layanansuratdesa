<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPenduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'surat_id', 'desa_id', 'status',
    ];

    // Relasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class);
    }

    public function detailSurats()
    {
        return $this->hasMany(DetailSurat::class);
    }

    public function anggotaAhliwaris()
    {
        return $this->hasMany(AnggotaAhliwaris::class);
    }

    public function anggotaKeluargaPindahs()
    {
        return $this->hasMany(AnggotaKeluargaPindah::class);
    }
}
