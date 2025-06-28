<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $surats = [
            [
                'no_surat' => '510/001/Pemb.BLK/VI/2024',
                'nama_surat' => 'Keterangan Usaha',
                'jenis_surat' => 'usaha',
            ],
            [
                'no_surat' => '401/......./Pemb.BLK/......../2024',
                'nama_surat' => 'Keterangan Tidak Mampu',
                'jenis_surat' => 'tidak_mampu',
            ],
            [
                'no_surat' => '471/......./BLK/......../2024',
                'nama_surat' => 'Keterangan Ahli Waris',
                'jenis_surat' => 'ahliwaris',
            ],
            [
                'no_surat' => '471/......./Pemb.BLK/......../2024',
                'nama_surat' => 'Keterangan Milik Tanah',
                'jenis_surat' => 'tanah',
            ],
            [
                'no_surat' => '510/......../Pemb.BLK/......../2024',
                'nama_surat' => 'Keterangan Pindah',
                'jenis_surat' => 'pindah',
            ],
            [
                'no_surat' => '510/Kades/52/52/01.01.2009/Tani/JBT/VI/2024',
                'nama_surat' => 'Rekomendasi BBM',
                'jenis_surat' => 'rekomendasibbm',
            ],
            [
                'no_surat' => '401/....../Kesra.BLK/....../2024',
                'nama_surat' => 'Keterangan Penghasilan Orang Tua',
                'jenis_surat' => 'penghasilan',
            ],
        ];

        foreach ($surats as $surat) {
            DB::table('surats')->insert([
                'no_surat' => $surat['no_surat'],
                'nama_surat' => $surat['nama_surat'],
                'jenis_surat' => $surat['jenis_surat'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}