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

class SuratTanahController extends Controller
{
    public function index()
    {
        // Ambil semua data surat tanah untuk user yang sedang login
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'tanah');
            })
            ->with(['surat', 'detailSurats', 'user'])->orderBy('created_at', 'desc')
            ->get();

        return view('content.surat.tanah.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $desas = Desa::all();
        $surat = Surat::where('jenis_surat', 'tanah')->first();
        return view('content.surat.tanah.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dusun' => 'required|string|max:255',
            'nama_desa_sktanah' => 'required|string|max:255',
            'kecamatan_sktanah' => 'required|string|max:255',
            'kabupaten_sktanah' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:50',
            'status_tanah' => 'required|string|max:255',
            'digunakan_untuk' => 'required|string|max:255',
            'cara_memperoleh' => 'required|string|max:255',
            'batas_utara' => 'required|string|max:255',
            'batas_timur' => 'required|string|max:255',
            'batas_selatan' => 'required|string|max:255',
            'batas_barat' => 'required|string|max:255',
            'keperluan_sktanah' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
        ], [
            'dusun.required' => 'Dusun tidak boleh kosong.',
            'nama_desa_sktanah.required' => 'Nama Desa tidak boleh kosong.',
            'kecamatan_sktanah.required' => 'Kecamatan tidak boleh kosong.',
            'kabupaten_sktanah.required' => 'Kabupaten tidak boleh kosong.',
            'luas_tanah.required' => 'Luas Tanah tidak boleh kosong.',
            'status_tanah.required' => 'Status Tanah tidak boleh kosong.',
            'digunakan_untuk.required' => 'Digunakan untuk tidak boleh kosong.',
            'cara_memperoleh.required' => 'Cara Memperoleh tidak boleh kosong.',
            'batas_utara.required' => 'Batas Utara tidak boleh kosong.',
            'batas_timur.required' => 'Batas Timur tidak boleh kosong.',
            'batas_selatan.required' => 'Batas Selatan tidak boleh kosong.',
            'batas_barat.required' => 'Batas Barat tidak boleh kosong.',
            'keperluan_sktanah.required' => 'Keperluan tidak boleh kosong.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surat = Surat::where('jenis_surat', 'tanah')->first();

        if (!$surat) {
            return redirect()->route('surat.tanah.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));

        if (!$desa) {
            return redirect()->route('surat.tanah.create')->with('error', 'Desa tidak ditemukan.');
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
            'dusun' => $request->dusun,
            'nama_desa_sktanah' => $request->nama_desa_sktanah,
            'kecamatan_sktanah' => $request->kecamatan_sktanah,
            'kabupaten_sktanah' => $request->kabupaten_sktanah,
            'luas_tanah' => $request->luas_tanah,
            'status_tanah' => $request->status_tanah,
            'digunakan_untuk' => $request->digunakan_untuk,
            'cara_memperoleh' => $request->cara_memperoleh,
            'batas_utara' => $request->batas_utara,
            'batas_timur' => $request->batas_timur,
            'batas_selatan' => $request->batas_selatan,
            'batas_barat' => $request->batas_barat,
            'keperluan_sktanah' => $request->keperluan_sktanah,
        ]);
        $detailSurat->save();

        return redirect()->route('surat.tanah.index')->with('success', 'Surat tanah berhasil disimpan.');
    }

    public function edit($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();
        $desas = Desa::all();
        return view('content.surat.tanah.edit', compact('suratPenduduk', 'detailSurat', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'dusun' => 'required|string|max:255',
            'nama_desa_sktanah' => 'required|string|max:255',
            'kecamatan_sktanah' => 'required|string|max:255',
            'kabupaten_sktanah' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:50',
            'status_tanah' => 'required|string|max:255',
            'digunakan_untuk' => 'required|string|max:255',
            'cara_memperoleh' => 'required|string|max:255',
            'batas_utara' => 'required|string|max:255',
            'batas_timur' => 'required|string|max:255',
            'batas_selatan' => 'required|string|max:255',
            'batas_barat' => 'required|string|max:255',
            'keperluan_sktanah' => 'required|string',
        ], [
            'dusun.required' => 'Dusun tidak boleh kosong.',
            'nama_desa_sktanah.required' => 'Nama Desa tidak boleh kosong.',
            'kecamatan_sktanah.required' => 'Kecamatan tidak boleh kosong.',
            'kabupaten_sktanah.required' => 'Kabupaten tidak boleh kosong.',
            'luas_tanah.required' => 'Luas Tanah tidak boleh kosong.',
            'status_tanah.required' => 'Status Tanah tidak boleh kosong.',
            'digunakan_untuk.required' => 'Digunakan untuk tidak boleh kosong.',
            'cara_memperoleh.required' => 'Cara Memperoleh tidak boleh kosong.',
            'batas_utara.required' => 'Batas Utara tidak boleh kosong.',
            'batas_timur.required' => 'Batas Timur tidak boleh kosong.',
            'batas_selatan.required' => 'Batas Selatan tidak boleh kosong.',
            'batas_barat.required' => 'Batas Barat tidak boleh kosong.',
            'keperluan_sktanah.required' => 'Keperluan tidak boleh kosong.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();

        $detailSurat->update([
            'dusun' => $request->dusun,
            'nama_desa_sktanah' => $request->nama_desa_sktanah,
            'kecamatan_sktanah' => $request->kecamatan_sktanah,
            'kabupaten_sktanah' => $request->kabupaten_sktanah,
            'luas_tanah' => $request->luas_tanah,
            'status_tanah' => $request->status_tanah,
            'digunakan_untuk' => $request->digunakan_untuk,
            'cara_memperoleh' => $request->cara_memperoleh,
            'batas_utara' => $request->batas_utara,
            'batas_timur' => $request->batas_timur,
            'batas_selatan' => $request->batas_selatan,
            'batas_barat' => $request->batas_barat,
            'keperluan_sktanah' => $request->keperluan_sktanah,
        ]);

        return redirect()->route('surat.tanah.index')->with('success', 'Surat tanah berhasil diupdate.');
    }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.tanah.index')->with('success', 'Surat tanah berhasil dihapus.');
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

        return view('content.surat.tanah.print', compact('suratPenduduk', 'path'));
    }
}