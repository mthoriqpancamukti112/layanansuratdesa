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

class SuratTidakMampuController extends Controller
{
    public function index()
    {
        // Ambil semua data surat tidak mampu untuk user yang sedang login
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'tidak_mampu');
            })
            ->with(['surat', 'detailSurats', 'user'])->orderBy('created_at', 'desc')
            ->get();

        return view('content.surat.tidakmampu.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $surat = Surat::where('jenis_surat', 'tidak_mampu')->first();
        $desas = Desa::all();
        return view('content.surat.tidakmampu.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keperluan_tidakmampu' => 'required|string',
            'upload_kk' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'upload_ktp' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'desa_id' => 'required|exists:desas,id',
        ], [
            'keperluan_tidakmampu.required' => 'Keperluan tidak mampu tidak boleh kosong.',
            'upload_kk.required' => 'Upload KK harus diisi.',
            'upload_kk.mimes' => 'File KK harus jpg, png, atau pdf.',
            'upload_kk.max' => 'File KK maksimal 2MB.',
            'upload_ktp.required' => 'Upload KTP harus diisi.',
            'upload_ktp.mimes' => 'File KTP harus jpg, png, atau pdf.',
            'upload_ktp.max' => 'File KTP maksimal 2MB.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surat = Surat::where('jenis_surat', 'tidak_mampu')->first();

        if (!$surat) {
            return redirect()->route('surat.tidakmampu.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));

        if (!$desa) {
            return redirect()->route('surat.tidakmampu.create')->with('error', 'Desa tidak ditemukan.');
        }

        $user = Auth::user();
        $username = $user->username;

        // Menangani upload kk berkas
        $kkFile = $request->file('upload_kk');
        $kkFileName = $username . '_' . date('YmdHis') . "_kk." . $kkFile->getClientOriginalExtension();
        $kkFilePath = $kkFile->move(public_path('berkas_sk_tidakmampu'), $kkFileName);

        // Menangani upload ktp berkas
        $ktpFile = $request->file('upload_ktp');
        $ktpFileName = $username . '_' . date('YmdHis') . "_ktp." . $ktpFile->getClientOriginalExtension();
        $ktpFilePath = $ktpFile->move(public_path('berkas_sk_tidakmampu'), $ktpFileName);

        // Tentukan status surat berdasarkan peran pengguna
        $status = Auth::user()->role === 'admin' ? 'disetujui' : 'diproses';

        $suratPenduduk = new SuratPenduduk([
            'surat_id' => $surat->id,
            'user_id' => Auth::id(),
            'desa_id' => $desa->id,
            'status' =>  $status,
        ]);
        $suratPenduduk->save();

        $detailSurat = new DetailSurat([
            'surat_penduduk_id' => $suratPenduduk->id,
            'keperluan_tidakmampu' => $request->keperluan_tidakmampu,
            'upload_kk' => $kkFileName,
            'upload_ktp' => $ktpFileName,
        ]);

        $detailSurat->save();

        return redirect()->route('surat.tidakmampu.index')->with('success', 'Surat tidak mampu berhasil disimpan.');
    }



    public function edit($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();
        $desas = Desa::all();
        return view('content.surat.tidakmampu.edit', compact('suratPenduduk', 'detailSurat', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keperluan_tidakmampu' => 'required|string',
            'upload_kk' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'upload_ktp' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'desa_id' => 'required|exists:desas,id',
        ], [
            'keperluan_tidakmampu.required' => 'Keperluan tidak mampu tidak boleh kosong.',
            'upload_kk.mimes' => 'File KK harus jpg, png, atau pdf.',
            'upload_kk.max' => 'File KK maksimal 2MB.',
            'upload_ktp.mimes' => 'File KTP harus jpg, png, atau pdf.',
            'upload_ktp.max' => 'File KTP maksimal 2MB.',
            'desa_id.required' => 'Desa tidak boleh kosong.',
            'desa_id.exists' => 'Desa tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();

        if ($request->hasFile('upload_kk')) {
            $fileKK = $request->file('upload_kk')->store('uploads', 'public');
            $detailSurat->upload_kk = $fileKK;
        }

        if ($request->hasFile('upload_ktp')) {
            $fileKTP = $request->file('upload_ktp')->store('uploads', 'public');
            $detailSurat->upload_ktp = $fileKTP;
        }

        $detailSurat->update([
            'keperluan_tidakmampu' => $request->keperluan_tidakmampu,
            'upload_kk' => $fileKK ?? $detailSurat->upload_kk,
            'upload_ktp' => $fileKTP ?? $detailSurat->upload_ktp,
        ]);

        return redirect()->route('surat.tidakmampu.index')->with('success', 'Surat tidak mampu berhasil diupdate.');
    }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.tidakmampu.index')->with('success', 'Surat tidak mampu berhasil dihapus.');
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

        return view('content.surat.tidakmampu.print', compact('suratPenduduk', 'path'));
    }
}