<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Validasi data input dari form
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,penduduk',
            'nik' => 'required|unique:admins,nik',
            'no_kk' => 'required|unique:admins,no_kk',
            'username' => 'required|unique:users,username',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'kewarganegaraan' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pendidikan' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'desa' => 'required',
        ]);

        $user = User::create([
            'nik' => $request->nik,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        Admin::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
            'username' => $request->username,
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
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'desa' => $request->desa,
            'tgl_buat' => Carbon::now(),
        ]);

        // Redirect atau kembalikan respon yang sesuai
        return redirect()->route('user.index')->with('success', 'Admin berhasil ditambahkan');
    }

    public function edit($id)
    {
        // Cari user berdasarkan ID
        $user = User::findOrFail($id);

        // Cari admin yang terkait dengan user, jika ada
        $admin = Admin::where('user_id', $user->id)->firstOrFail();

        return view('admin.user.edit', compact('user', 'admin'));
    }


    public function update(Request $request, $id)
    {
        // Temukan admin berdasarkan ID
        $admin = Admin::findOrFail($id);
        $user = $admin->user;  // Mengambil user terkait dari admin

        // Validasi data input dari form
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',  // Password tidak harus diisi saat update
            'role' => 'required|in:admin,penduduk',
            'nik' => 'required|unique:admins,nik,' . $admin->id,
            'no_kk' => 'required|unique:admins,no_kk,' . $admin->id,
            'username' => 'required|unique:users,username,' . $user->id,
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'kewarganegaraan' => 'required',
            'agama' => 'required',
            'status' => 'required',
            'pendidikan' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'desa' => 'required',
        ]);

        // Update data user terkait
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Jika password diisi, maka update password
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // Update data admin
        $admin->update([
            'nik' => $request->nik,
            'no_kk' => $request->no_kk,
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
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'desa' => $request->desa,
            'tgl_buat' => Carbon::now(),
        ]);

        // Redirect atau kembalikan respon yang sesuai
        return redirect()->route('user.index')->with('success', 'Data admin berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Temukan admin yang terkait dengan user
        $admin = Admin::where('user_id', $user->id)->first();

        if ($admin) {
            // Hapus admin terlebih dahulu
            $admin->delete();
        }

        // Hapus user setelah admin dihapus (jika ada)
        $user->delete();

        // Redirect atau kembalikan respon yang sesuai
        return redirect()->route('user.index')->with('success', 'Admin berhasil dihapus!');
    }
}