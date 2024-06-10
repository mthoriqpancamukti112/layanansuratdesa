<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\PermohonanSurat;
use App\Models\Surat;
use App\Models\SuratPenduduk;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hitung_penduduk = Penduduk::count();
        $hitung_user = User::count();
        $hitung_surat_diproses = SuratPenduduk::where('status', 'diproses')->count();
        $hitung_total_buat_surat = SuratPenduduk::count();
        $hitung_permohonan = PermohonanSurat::count();

        // Menghitung jumlah surat yang sudah diarsipkan tanpa kondisi spesifik
        $surat_arsip_counts = SuratPenduduk::select('surat_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->join('surats', 'surat_penduduks.surat_id', '=', 'surats.id')
            ->groupBy('surat_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->surat_id => $item->total];
            });

        return view('content.dashboard.dashboard', compact('hitung_penduduk', 'hitung_user', 'hitung_surat_diproses', 'hitung_total_buat_surat', 'surat_arsip_counts', 'hitung_permohonan'));
    }

    public function arsipsurat()
    {
        $suratPenduduks = SuratPenduduk::with(['user', 'surat', 'detailSurats'])->orderBy('created_at', 'desc')->get();
        return view('content.surat.arsip-surat', compact('suratPenduduks'));
    }
}
