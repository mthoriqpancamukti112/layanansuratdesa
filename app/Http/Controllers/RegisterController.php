<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|unique:users,nik|max:16',
            'username' => 'required|string|unique:users,username|max:255',
            'no_kk' => 'required|string|max:20',
            'jk' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'pendidikan' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 karakter.',
            'username.required' => 'Username tidak boleh kosong.',
            'username.unique' => 'Username sudah terdaftar.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'no_kk.required' => 'Nomor KK tidak boleh kosong.',
            'no_kk.max' => 'Nomor KK tidak boleh lebih dari 20 karakter.',
            'jk.required' => 'Jenis kelamin tidak boleh kosong.',
            'jk.max' => 'Jenis kelamin tidak boleh lebih dari 10 karakter.',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari 100 karakter.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
            'kewarganegaraan.required' => 'Kewarganegaraan tidak boleh kosong.',
            'kewarganegaraan.max' => 'Kewarganegaraan tidak boleh lebih dari 50 karakter.',
            'agama.required' => 'Agama tidak boleh kosong.',
            'agama.max' => 'Agama tidak boleh lebih dari 50 karakter.',
            'status.required' => 'Status tidak boleh kosong.',
            'status.max' => 'Status tidak boleh lebih dari 50 karakter.',
            'pendidikan.required' => 'Pendidikan tidak boleh kosong.',
            'pendidikan.max' => 'Pendidikan tidak boleh lebih dari 50 karakter.',
            'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari 100 karakter.',
            'provinsi.required' => 'Provinsi tidak boleh kosong.',
            'provinsi.max' => 'Provinsi tidak boleh lebih dari 100 karakter.',
            'kabupaten.required' => 'Kabupaten tidak boleh kosong.',
            'kabupaten.max' => 'Kabupaten tidak boleh lebih dari 100 karakter.',
            'kecamatan.required' => 'Kecamatan tidak boleh kosong.',
            'kecamatan.max' => 'Kecamatan tidak boleh lebih dari 100 karakter.',
            'desa.required' => 'Desa tidak boleh kosong.',
            'desa.max' => 'Desa tidak boleh lebih dari 100 karakter.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 15 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data pengguna (User)
        $user = User::create([
            'nik' => $request->nik,
            'username' => $request->username,
            'email' => $request->email ?? null,
            'password' => $request->password ? Hash::make($request->password) : null,
            'role' => 'penduduk',
        ]);

        // Simpan data penduduk
        $penduduk = Penduduk::create([
            'user_id' => $user->id,
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'kewarganegaraan' => $request->kewarganegaraan,
            'agama' => $request->agama,
            'status' => $request->status,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('user.login.index')->with('success', 'Pendaftaran berhasil. Silahkan login.');
    }
}
