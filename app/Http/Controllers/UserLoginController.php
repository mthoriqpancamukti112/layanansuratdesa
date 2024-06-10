<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function index()
    {
        return view('auth.user-login');
    }

    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required',
            'username' => 'required',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'username.required' => 'Nama lengkap tidak boleh kosong.',
        ]);

        // Mencari pengguna berdasarkan NIK dan username
        $user = User::where('nik', $request->nik)
            ->where('username', $request->username)
            ->first();

        // Jika pengguna ditemukan
        if ($user) {
            // Jika peran pengguna adalah 'penduduk'
            if ($user->role == 'penduduk') {
                // Login pengguna
                Auth::login($user);
                return redirect('/dashboard');
            } else {
                // Logout pengguna
                Auth::logout();
                return back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        } else {

            return back()->with('error', 'NIK atau nama lengkap anda tidak sesuai');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil logout');
    }
}
