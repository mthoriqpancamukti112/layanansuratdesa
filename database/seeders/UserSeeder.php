<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        $userId = DB::table('users')->insertGetId([
            'nik' => 'null',
            'username' => 'Admin Desa Beleka',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Create an admin record
        DB::table('admins')->insert([
            'user_id' => $userId,
            'nik' => '1234567890123456',
            'no_kk' => '8766547656546546',
            'username' => 'admin',
            'jk' => 'Laki-laki',
            'tempat_lahir' => 'Mataram',
            'tgl_lahir' => '2000-09-05',
            'kewarganegaraan' => 'Indonesia',
            'agama' => 'Islam',
            'status' => 'Menikah',
            'pendidikan' => 'S1',
            'pekerjaan' => 'Administrator',
            'provinsi' => 'Nusa Tenggara Barat',
            'kabupaten' => 'Mataram',
            'kecamatan' => 'Amepnan',
            'alamat' => 'Jl. Jenderal Sudirman No.1',
            'no_hp' => '081234567890',
            'desa' => 'Pejarakan Karya',
            'tgl_buat' => Carbon::now(),
            'last_login' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}