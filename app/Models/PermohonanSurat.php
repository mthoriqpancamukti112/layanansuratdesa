<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'jenis_surat',
        'no_hp',
        'foto',
        'upload',
        'tgl_buat',
        'status',
    ];
}
