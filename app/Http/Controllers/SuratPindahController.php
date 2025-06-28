<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluargaPindah;
use App\Models\Desa;
use App\Models\DetailSurat;
use App\Models\Surat;
use App\Models\SuratPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use BaconQrCode\Renderer\GDLibRenderer;
use BaconQrCode\Writer;

class SuratPindahController extends Controller
{
    public function index()
    {
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'pindah');
            })
            ->with(['surat', 'detailSurats', 'anggotaKeluargaPindahs', 'user'])->orderBy('created_at', 'desc')
            ->get();

        return view('content.surat.pindah.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $surat = Surat::where('jenis_surat', 'pindah')->first();
        $desas = Desa::all();
        return view('content.surat.pindah.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alasan_pindah' => 'required|string',
            'alamat_tujuan_pindah' => 'required|string',
            'nama_desa_pindah' => 'required|string',
            'kecamatan_pindah' => 'required|string',
            'kabupaten_pindah' => 'required|string',
            'provinsi_pindah' => 'required|string',
            'no_telp' => 'nullable|string',
            'kode_pos' => 'required|integer',
            'rt' => 'required|integer',
            'rw' => 'required|integer',
            'klasifikasi_pindah' => 'required|in:Satu Desa/Kelurahan,Antar Desa/Kelurahan,Antar Kecamatan,Antar Kab/Kota,Antar Provinsi',
            'jenis_perpindahan' => 'required|in:Kepala Keluarga,Kep. Keluarga dan Seluruh Anggota Keluarga,Kep. Keluarga dan Sebagian Anggota Keluarga,Anggota Keluarga',
            'status_no_kk_tidakpindah' => 'required|in:Numpang KK,Membuat KK baru,Tidak ada anggota keluarga yang ditinggal,Nomor KK tetap',
            'status_no_kk_pindah' => 'required|in:Numpang KK,Membuat KK baru,Nama Kep. keluarga dan No. KK tetap',
            'rencana_tgl_pindah' => 'required|date',
            'anggota' => 'required|array|min:1',
            'anggota.*.nik' => 'required|string|max:16',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.shdk' => 'required|string|max:50',
        ], [
            'alasan_pindah.required' => 'Alasan pindah harus diisi.',
            'alamat_tujuan_pindah.required' => 'Alamat tujuan pindah harus diisi.',
            'nama_desa_pindah.required' => 'Desa tujuan pindah harus diisi.',
            'kecamatan_pindah.required' => 'Kecamatan tujuan pindah harus diisi.',
            'kabupaten_pindah.required' => 'Kabupaten tujuan pindah harus diisi.',
            'provinsi_pindah.required' => 'Provinsi tujuan pindah harus diisi.',
            'no_telp.string' => 'Nomor telepon harus berupa teks.',
            'kode_pos.required' => 'Kode pos harus diisi.',
            'kode_pos.integer' => 'Kode pos harus berupa angka.',
            'rt.required' => 'RT harus diisi.',
            'rt.integer' => 'RT harus berupa angka.',
            'rw.required' => 'RW harus diisi.',
            'rw.integer' => 'RW harus berupa angka.',
            'klasifikasi_pindah.required' => 'Klasifikasi pindah harus dipilih.',
            'jenis_perpindahan.required' => 'Jenis perpindahan harus dipilih.',
            'status_no_kk_tidakpindah.required' => 'Status nomor KK tidak pindah harus dipilih.',
            'status_no_kk_pindah.required' => 'Status nomor KK pindah harus dipilih.',
            'rencana_tgl_pindah.required' => 'Tanggal rencana pindah harus diisi.',
            'anggota.required' => 'Anggota keluarga pindah harus diisi.',
            'anggota.*.nik.required' => 'NIK anggota keluarga pindah harus diisi.',
            'anggota.*.nama.required' => 'Nama anggota keluarga pindah harus diisi.',
            'anggota.*.shdk.required' => 'SHDK anggota keluarga pindah harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surat = Surat::where('jenis_surat', 'pindah')->first();
        if (!$surat) {
            return redirect()->route('surat.pindah.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));
        if (!$desa) {
            return redirect()->route('surat.pindah.create')->with('error', 'Desa tidak ditemukan.');
        }

        // Tentukan status surat berdasarkan peran pengguna
        $status = Auth::user()->role === 'admin' ? 'disetujui' : 'diproses';

        $suratPenduduk = new SuratPenduduk([
            'surat_id' => $surat->id,
            'desa_id' => $desa->id,
            'user_id' => Auth::id(),
            'status' => $status,
        ]);
        $suratPenduduk->save();

        $detailSurat = new DetailSurat([
            'surat_penduduk_id' => $suratPenduduk->id,
            'alasan_pindah' => $request->alasan_pindah,
            'alamat_tujuan_pindah' => $request->alamat_tujuan_pindah,
            'nama_desa_pindah' => $request->nama_desa_pindah,
            'kecamatan_pindah' => $request->kecamatan_pindah,
            'kabupaten_pindah' => $request->kabupaten_pindah,
            'provinsi_pindah' => $request->provinsi_pindah,
            'no_telp' => $request->no_telp,
            'kode_pos' => $request->kode_pos,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'klasifikasi_pindah' => $request->klasifikasi_pindah,
            'jenis_perpindahan' => $request->jenis_perpindahan,
            'status_no_kk_tidakpindah' => $request->status_no_kk_tidakpindah,
            'status_no_kk_pindah' => $request->status_no_kk_pindah,
            'rencana_tgl_pindah' => $request->rencana_tgl_pindah,
        ]);
        $detailSurat->save();

        foreach ($request->anggota as $anggota) {
            AnggotaKeluargaPindah::create([
                'surat_penduduk_id' => $suratPenduduk->id,
                'nik' => $anggota['nik'],
                'nama' => $anggota['nama'],
                'shdk' => $anggota['shdk'],
            ]);
        }

        return redirect()->route('surat.pindah.index')->with('success', 'Surat pindah berhasil disimpan.');
    }

    public function edit($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();
        $anggotaKeluargaPindahs = $suratPenduduk->anggotaKeluargaPindahs;
        $desas = Desa::all();
        return view('content.surat.pindah.edit', compact('suratPenduduk', 'detailSurat', 'anggotaKeluargaPindahs', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'alasan_pindah' => 'required|string',
            'alamat_tujuan_pindah' => 'required|string',
            'nama_desa_pindah' => 'required|string',
            'kecamatan_pindah' => 'required|string',
            'kabupaten_pindah' => 'required|string',
            'provinsi_pindah' => 'required|string',
            'no_telp' => 'nullable|string',
            'kode_pos' => 'nullable|integer',
            'rt' => 'nullable|integer',
            'rw' => 'nullable|integer',
            'klasifikasi_pindah' => 'required|in:Satu Desa/Kelurahan,Antar Desa/Kelurahan,Antar Kecamatan,Antar Kab/Kota,Antar Provinsi',
            'jenis_perpindahan' => 'required|in:Kepala Keluarga,Kep. Keluarga dan Seluruh Anggota Keluarga,Kep. Keluarga dan Sebagian Anggota Keluarga,Anggota Keluarga',
            'status_no_kk_tidakpindah' => 'required|in:Numpang KK,Membuat KK baru,Tidak ada anggota keluarga yang ditinggal,Nomor KK tetap',
            'status_no_kk_pindah' => 'required|in:Numpang KK,Membuat KK baru,Nama Kep. keluarga dan No. KK tetap',
            'rencana_tgl_pindah' => 'required|date',
            'anggota' => 'required|array|min:1',
            'anggota.*.nik' => 'required|string|max:16',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.shdk' => 'required|string|max:50',
        ], [
            'alasan_pindah.required' => 'Alasan pindah harus diisi.',
            'alamat_tujuan_pindah.required' => 'Alamat tujuan pindah harus diisi.',
            'nama_desa_pindah.required' => 'Desa tujuan pindah harus diisi.',
            'kecamatan_pindah.required' => 'Kecamatan tujuan pindah harus diisi.',
            'kabupaten_pindah.required' => 'Kabupaten tujuan pindah harus diisi.',
            'provinsi_pindah.required' => 'Provinsi tujuan pindah harus diisi.',
            'no_telp.string' => 'Nomor telepon harus berupa teks.',
            'kode_pos.integer' => 'Kode pos harus berupa angka.',
            'rt.integer' => 'RT harus berupa angka.',
            'rw.integer' => 'RW harus berupa angka.',
            'klasifikasi_pindah.required' => 'Klasifikasi pindah harus dipilih.',
            'jenis_perpindahan.required' => 'Jenis perpindahan harus dipilih.',
            'status_no_kk_tidakpindah.required' => 'Status nomor KK tidak pindah harus dipilih.',
            'status_no_kk_pindah.required' => 'Status nomor KK pindah harus dipilih.',
            'rencana_tgl_pindah.required' => 'Tanggal rencana pindah harus diisi.',
            'anggota.required' => 'Anggota keluarga pindah harus diisi.',
            'anggota.*.nik.required' => 'NIK anggota keluarga pindah harus diisi.',
            'anggota.*.nama.required' => 'Nama anggota keluarga pindah harus diisi.',
            'anggota.*.shdk.required' => 'SHDK anggota keluarga pindah harus diisi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();

        $detailSurat->update([
            'alasan_pindah' => $request->alasan_pindah,
            'alamat_tujuan_pindah' => $request->alamat_tujuan_pindah,
            'nama_desa_pindah' => $request->nama_desa_pindah,
            'kecamatan_pindah' => $request->kecamatan_pindah,
            'kabupaten_pindah' => $request->kabupaten_pindah,
            'provinsi_pindah' => $request->provinsi_pindah,
            'no_telp' => $request->no_telp,
            'kode_pos' => $request->kode_pos,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'klasifikasi_pindah' => $request->klasifikasi_pindah,
            'jenis_perpindahan' => $request->jenis_perpindahan,
            'status_no_kk_tidakpindah' => $request->status_no_kk_tidakpindah,
            'status_no_kk_pindah' => $request->status_no_kk_pindah,
            'rencana_tgl_pindah' => $request->rencana_tgl_pindah,
        ]);

        AnggotaKeluargaPindah::where('surat_penduduk_id', $id)->delete();

        foreach ($request->anggota as $anggota) {
            AnggotaKeluargaPindah::create([
                'surat_penduduk_id' => $suratPenduduk->id,
                'nik' => $anggota['nik'],
                'nama' => $anggota['nama'],
                'shdk' => $anggota['shdk'],
            ]);
        }

        $suratPenduduk->update([
            'desa_id' => $request->desa_id,
        ]);

        return redirect()->route('surat.pindah.index')->with('success', 'Surat pindah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.pindah.index')->with('success', 'Surat pindah berhasil dihapus.');
    }

    public function print($id)
    {
        $suratPenduduk = SuratPenduduk::with(['surat', 'detailSurats', 'anggotaKeluargaPindahs', 'user.penduduk'])->findOrFail($id);

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

        return view('content.surat.pindah.print', compact('suratPenduduk', 'path'));
    }
}