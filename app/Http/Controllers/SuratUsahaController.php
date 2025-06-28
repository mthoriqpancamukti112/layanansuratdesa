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

class SuratUsahaController extends Controller
{
    public function index()
    {
        // Ambil semua data surat usaha untuk user yang sedang login
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'usaha');
            })->with(['surat', 'detailSurats', 'user'])->orderBy('created_at', 'desc')->get();

        return view('content.surat.usaha.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $surat = Surat::where('jenis_surat', 'usaha')->first();
        $desas = Desa::all();
        return view('content.surat.usaha.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'bidang_usaha' => 'required|string|max:255',
            'berjalan_sejak' => 'required|date',
            'alamat_usaha' => 'required|string',
            'nama_usaha_skusaha' => 'required|string|max:255',
            'desa_id' => 'required|exists:desas,id',
        ], [
            'bidang_usaha.required' => 'Bidang usaha tidak boleh kosong.',
            'berjalan_sejak.required' => 'Tanggal berjalan sejak tidak boleh kosong.',
            'alamat_usaha.required' => 'Alamat usaha tidak boleh kosong.',
            'nama_usaha_skusaha.required' => 'Nama usaha tidak boleh kosong.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Ambil surat berdasarkan jenis
        $surat = Surat::where('jenis_surat', 'usaha')->first();

        if (!$surat) {
            return redirect()->route('surat.usaha.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));

        if (!$desa) {
            return redirect()->route('surat.usaha.create')->with('error', 'Desa tidak ditemukan.');
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
            'bidang_usaha' => $request->bidang_usaha,
            'berjalan_sejak' => $request->berjalan_sejak,
            'alamat_usaha' => $request->alamat_usaha,
            'nama_usaha_skusaha' => $request->nama_usaha_skusaha,
        ]);
        $detailSurat->save();

        return redirect()->route('surat.usaha.index')->with('success', 'Surat usaha berhasil disimpan.');
    }

    // public function edit($id)
    // {
    //     $suratPenduduk = SuratPenduduk::findOrFail($id);
    //     $detailSurat = $suratPenduduk->detailSurats()->first(); // Ambil detail pertama untuk diedit
    //     return view('content.surat.usaha.edit', compact('suratPenduduk', 'detailSurat'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'bidang_usaha' => 'required|string|max:255',
    //         'berjalan_sejak' => 'required|date',
    //         'alamat_usaha' => 'required|string',
    //         'nama_usaha_skusaha' => 'required|string|max:255',
    //     ], [
    //         'bidang_usaha.required' => 'Bidang usaha tidak boleh kosong.',
    //         'berjalan_sejak.required' => 'Tanggal berjalan sejak tidak boleh kosong.',
    //         'alamat_usaha.required' => 'Alamat usaha tidak boleh kosong.',
    //         'nama_usaha_skusaha.required' => 'Nama usaha tidak boleh kosong.',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $suratPenduduk = SuratPenduduk::findOrFail($id);
    //     $detailSurat = $suratPenduduk->detailSurats()->first();

    //     $detailSurat->update([
    //         'bidang_usaha' => $request->bidang_usaha,
    //         'berjalan_sejak' => $request->berjalan_sejak,
    //         'alamat_usaha' => $request->alamat_usaha,
    //         'nama_usaha_skusaha' => $request->nama_usaha_skusaha,
    //     ]);

    //     return redirect()->route('surat.usaha.index')->with('success', 'Surat usaha berhasil diupdate.');
    // }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.usaha.index')->with('success', 'Surat usaha berhasil dihapus.');
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

        return view('content.surat.usaha.print', compact('suratPenduduk', 'path'));
    }
}