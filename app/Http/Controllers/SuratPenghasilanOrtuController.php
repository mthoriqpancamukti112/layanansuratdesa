<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\DetailSurat;
use App\Models\Surat;
use App\Models\SuratPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class SuratPenghasilanOrtuController extends Controller
{
    public function index()
    {
        // Ambil semua data surat penghasilan untuk user yang sedang login
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'penghasilan');
            })->with(['surat', 'detailSurats', 'user'])->orderBy('created_at', 'desc')->get();

        return view('content.surat.penghasilan.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $surat = Surat::where('jenis_surat', 'penghasilan')->first();
        $desas = Desa::all();
        return view('content.surat.penghasilan.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'jumlah_penghasilan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
            'desa_id' => 'required|exists:desas,id',
        ], [
            'jumlah_penghasilan.required' => 'Jumlah penghasilan tidak boleh kosong.',
            'keperluan.required' => 'Keperluan tidak boleh kosong.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil surat berdasarkan jenis
        $surat = Surat::where('jenis_surat', 'penghasilan')->first();

        if (!$surat) {
            return redirect()->route('surat.penghasilan.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));

        if (!$desa) {
            return redirect()->route('surat.penghasilan.create')->with('error', 'Desa tidak ditemukan.');
        }

        // Tentukan status surat berdasarkan peran pengguna
        $status = Auth::user()->role === 'admin' ? 'disetujui' : 'diproses';

        // Simpan data ke surat_penduduks
        $suratPenduduk = new SuratPenduduk([
            'surat_id' => $surat->id,
            'user_id' => Auth::id(),
            'desa_id' => $desa->id,
            'status' => $status,
        ]);
        $suratPenduduk->save();

        // Simpan data ke detail_surats
        $detailSurat = new DetailSurat([
            'surat_penduduk_id' => $suratPenduduk->id,
            'jumlah_penghasilan' => $request->jumlah_penghasilan,
            'keperluan' => $request->keperluan,
        ]);
        $detailSurat->save();

        return redirect()->route('surat.penghasilan.index')->with('success', 'Surat penghasilan berhasil disimpan.');
    }

    // public function edit($id)
    // {
    //     $suratPenduduk = SuratPenduduk::findOrFail($id);
    //     $detailSurat = $suratPenduduk->detailSurats()->first(); // Ambil detail pertama untuk diedit
    //     return view('content.surat.penghasilan.edit', compact('suratPenduduk', 'detailSurat'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'jumlah_penghasilan' => 'required|string|max:255',
    //         'keperluan' => 'required|string|max:255',
    //     ], [
    //         'jumlah_penghasilan.required' => 'Jumlah penghasilan tidak boleh kosong.',
    //         'keperluan.required' => 'Keperluan tidak boleh kosong.',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $suratPenduduk = SuratPenduduk::findOrFail($id);
    //     $detailSurat = $suratPenduduk->detailSurats()->first();

    //     $detailSurat->update([
    //         'jumlah_penghasilan' => $request->jumlah_penghasilan,
    //         'keperluan' => $request->keperluan,
    //     ]);

    //     return redirect()->route('surat.penghasilan.index')->with('success', 'Surat penghasilan berhasil diupdate.');
    // }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.penghasilan.index')->with('success', 'Surat penghasilan berhasil dihapus.');
    }

    public function print($id)
    {
        $suratPenduduk = SuratPenduduk::with(['surat', 'detailSurats', 'user.penduduk', 'desa'])->findOrFail($id);

        // Data yang akan dimasukkan ke dalam kode QR
        $qrData = $suratPenduduk->user->nik . ' - ' . $suratPenduduk->user->username;

        // Mengatur ukuran kode QR
        $size = 100; // Ubah ukuran sesuai kebutuhan

        // Membuat renderer dan writer untuk kode QR
        $renderer = new GDLibRenderer($size);
        $writer = new Writer($renderer);

        // Membuat folder 'public/barcode' jika belum ada
        $barcodePath = public_path('barcode');
        if (!file_exists($barcodePath)) {
            mkdir($barcodePath, 0777, true);
        }

        // Menghasilkan nama file dengan username
        $filename = 'qrcode_' . $suratPenduduk->user->username . '_' . $suratPenduduk->surat->jenis_surat . '.png';
        $path = $barcodePath . '/' . $filename;

        // Menulis kode QR ke file
        $writer->writeFile($qrData, $path);

        return view('content.surat.penghasilan.print', compact('suratPenduduk', 'path'));
    }
}