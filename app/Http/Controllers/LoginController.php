<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email tidak boleh kosong.',
            'email.email' => 'Email tidak valid.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password terdiri dari :min.',
        ]);

        // Mencoba autentikasi
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Jika autentikasi berhasil
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'penduduk') {
                return redirect('/dashboard');
            } else {
                Auth::logout(); // Jika peran tidak sesuai, logout pengguna
                return back()->with('error', 'Anda tidak memiliki akses ke halaman ini');
            }
        }

        // Jika autentikasi gagal
        return back()->with('error', 'Periksa kembali email dan password Anda');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index')->with('success', 'Berhasil logout');
    }
}
