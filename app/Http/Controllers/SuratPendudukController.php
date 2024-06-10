<?php

namespace App\Http\Controllers;

use App\Models\SuratPenduduk;
use Illuminate\Http\Request;

class SuratPendudukController extends Controller
{
    // Menampilkan daftar surat
    public function index()
    {
        $suratPenduduks = SuratPenduduk::with(['user', 'surat', 'detailSurats'])
            ->where('status', 'diproses')->orderBy('created_at', 'desc')
            ->get();

        return view('admin.surat.index', compact('suratPenduduks'));
    }

    // Menangani aksi approve surat
    public function acc($id)
    {

        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->status = 'disetujui';
        $suratPenduduk->save();

        return redirect()->route('surat.penduduk.index')->with('success', 'Surat berhasil disetujui.');
    }


    // Menangani aksi hapus surat
    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.penduduk.index')->with('success', 'Surat berhasil dihapus.');
    }

    public function verifikasi($id)
    {
        $suratPenduduk = SuratPenduduk::with(['user', 'surat', 'detailSurats'])->findOrFail($id);

        return view('content.surat.verifikasi', compact('suratPenduduk'));
    }

    // Menampilkan notifikasi baru
    public function notifications()
    {
        // Ambil semua notifikasi dengan urutan terbaru
        $notifications = SuratPenduduk::with(['user', 'surat'])
            ->where('status', 'diproses')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($notifications === null) {
            return redirect()->back()->withErrors('Tidak ada notifikasi surat baru.');
        }

        return view('admin.notifications', compact('notifications'));
    }
}
