<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Surat;
use App\Models\SuratPenduduk;
use App\Models\DetailSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class SuratRekomendasiBBMController extends Controller
{
    public function index()
    {
        // Ambil semua data surat rekomendasi BBM untuk user yang sedang login
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'rekomendasibbm');
            })
            ->with(['surat', 'detailSurats', 'user'])->orderBy('created_at', 'desc')
            ->get();

        return view('content.surat.rekomendasibbm.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $surat = Surat::where('jenis_surat', 'rekomendasibbm')->first();
        $desas = Desa::all();
        return view('content.surat.rekomendasibbm.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'desa_id' => 'required|exists:desas,id',
            'nama_usaha_rekomendasibbm' => 'required|string|max:255',
            'konsumen_pengguna' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'jenis_alat' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'jumlah_alat' => 'required|string|max:50',
            'daya_alat' => 'required|string|max:255',
            'lama_penggunaan' => 'required|string|max:255',
            'lama_operasi_alat' => 'required|string|max:255',
            'konsumsi' => 'required|string|max:255',
            'alat_pembelian_digunakan' => 'required|string|max:255',
        ], [
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
            'nama_usaha_rekomendasibbm.required' => 'Nama usaha tidak boleh kosong.',
            'konsumen_pengguna.required' => 'Konsumen pengguna tidak boleh kosong.',
            'jenis_usaha.required' => 'Jenis usaha tidak boleh kosong.',
            'jenis_alat.required' => 'Jenis alat tidak boleh kosong.',
            'fungsi.required' => 'Fungsi tidak boleh kosong.',
            'jumlah_alat.required' => 'Jumlah alat tidak boleh kosong.',
            'daya_alat.required' => 'Daya alat tidak boleh kosong.',
            'lama_penggunaan.required' => 'Lama penggunaan tidak boleh kosong.',
            'lama_operasi_alat.required' => 'Lama operasi alat tidak boleh kosong.',
            'konsumsi.required' => 'Konsumsi tidak boleh kosong.',
            'alat_pembelian_digunakan.required' => 'Alat pembelian digunakan tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surat = Surat::where('jenis_surat', 'rekomendasibbm')->first();

        if (!$surat) {
            return redirect()->route('surat.rekomendasibbm.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));

        if (!$desa) {
            return redirect()->route('surat.rekomendasibbm.create')->with('error', 'Desa tidak ditemukan.');
        }

        // Tentukan status surat berdasarkan peran pengguna
        $status = Auth::user()->role === 'admin' ? 'disetujui' : 'diproses';

        $suratPenduduk = new SuratPenduduk([
            'surat_id' => $surat->id,
            'user_id' => Auth::id(),
            'desa_id' => $desa->id,
            'status' => $status,
        ]);
        $suratPenduduk->save();

        $detailSurat = new DetailSurat([
            'surat_penduduk_id' => $suratPenduduk->id,
            'nama_usaha_rekomendasibbm' => $request->nama_usaha_rekomendasibbm,
            'konsumen_pengguna' => $request->konsumen_pengguna,
            'jenis_usaha' => $request->jenis_usaha,
            'jenis_alat' => $request->jenis_alat,
            'fungsi' => $request->fungsi,
            'jumlah_alat' => $request->jumlah_alat,
            'daya_alat' => $request->daya_alat,
            'lama_penggunaan' => $request->lama_penggunaan,
            'lama_operasi_alat' => $request->lama_operasi_alat,
            'konsumsi' => $request->konsumsi,
            'alat_pembelian_digunakan' => $request->alat_pembelian_digunakan,
        ]);
        $detailSurat->save();

        return redirect()->route('surat.rekomendasibbm.index')->with('success', 'Surat rekomendasi BBM berhasil disimpan.');
    }

    public function edit($id)
    {
        $suratPenduduk = SuratPenduduk::with(['surat', 'detailSurats'])->findOrFail($id);
        $desas = Desa::all();
        return view('content.surat.rekomendasibbm.edit', compact('suratPenduduk', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'desa_id' => 'required|exists:desas,id',
            'nama_usaha_rekomendasibbm' => 'required|string|max:255',
            'konsumen_pengguna' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'jenis_alat' => 'required|string|max:255',
            'fungsi' => 'required|string|max:255',
            'jumlah_alat' => 'required|string|max:50',
            'daya_alat' => 'required|string|max:255',
            'lama_penggunaan' => 'required|string|max:255',
            'lama_operasi_alat' => 'required|string|max:255',
            'konsumsi' => 'required|string|max:255',
            'alat_pembelian_digunakan' => 'required|string|max:255',
        ], [
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
            'nama_usaha_rekomendasibbm.required' => 'Nama usaha tidak boleh kosong.',
            'konsumen_pengguna.required' => 'Konsumen pengguna tidak boleh kosong.',
            'jenis_usaha.required' => 'Jenis usaha tidak boleh kosong.',
            'jenis_alat.required' => 'Jenis alat tidak boleh kosong.',
            'fungsi.required' => 'Fungsi tidak boleh kosong.',
            'jumlah_alat.required' => 'Jumlah alat tidak boleh kosong.',
            'daya_alat.required' => 'Daya alat tidak boleh kosong.',
            'lama_penggunaan.required' => 'Lama penggunaan tidak boleh kosong.',
            'lama_operasi_alat.required' => 'Lama operasi alat tidak boleh kosong.',
            'konsumsi.required' => 'Konsumsi tidak boleh kosong.',
            'alat_pembelian_digunakan.required' => 'Alat pembelian digunakan tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();

        $suratPenduduk->desa_id = $request->desa_id;
        $suratPenduduk->save();

        $detailSurat->update([
            'nama_usaha_rekomendasibbm' => $request->nama_usaha_rekomendasibbm,
            'konsumen_pengguna' => $request->konsumen_pengguna,
            'jenis_usaha' => $request->jenis_usaha,
            'jenis_alat' => $request->jenis_alat,
            'fungsi' => $request->fungsi,
            'jumlah_alat' => $request->jumlah_alat,
            'daya_alat' => $request->daya_alat,
            'lama_penggunaan' => $request->lama_penggunaan,
            'lama_operasi_alat' => $request->lama_operasi_alat,
            'konsumsi' => $request->konsumsi,
            'alat_pembelian_digunakan' => $request->alat_pembelian_digunakan,
        ]);

        return redirect()->route('surat.rekomendasibbm.index')->with('success', 'Surat rekomendasi BBM berhasil diupdate.');
    }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.rekomendasibbm.index')->with('success', 'Surat rekomendasi BBM berhasil dihapus.');
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

        return view('content.surat.rekomendasibbm.print', compact('suratPenduduk', 'path'));
    }
}