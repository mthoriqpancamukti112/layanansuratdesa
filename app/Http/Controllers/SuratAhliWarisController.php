<?php

namespace App\Http\Controllers;

use App\Models\AnggotaAhliWaris;
use App\Models\Desa;
use App\Models\DetailSurat;
use App\Models\Surat;
use App\Models\SuratPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuratAhliWarisController extends Controller
{
    public function index()
    {
        $suratPenduduks = SuratPenduduk::where('user_id', Auth::id())
            ->whereHas('surat', function ($query) {
                $query->where('jenis_surat', 'ahliwaris');
            })
            ->with(['surat', 'detailSurats', 'anggotaAhliwaris', 'user'])->orderBy('created_at', 'desc')
            ->get();

        return view('content.surat.ahliwaris.index', compact('suratPenduduks'));
    }

    public function create()
    {
        $surat = Surat::where('jenis_surat', 'ahliwaris')->first();
        $desas = Desa::all();
        return view('content.surat.ahliwaris.create', compact('surat', 'desas'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'keperluan_ahliwaris' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
            'anggota' => 'required|array|min:1',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.nik' => 'required|string|max:16',
            'anggota.*.tempat_lahir' => 'required|string|max:255',
            'anggota.*.tgl_lahir' => 'required|date',
            'anggota.*.jk' => 'required|in:Laki-laki,Perempuan',
        ], [
            'keperluan_ahliwaris.required' => 'Keperluan ahli waris harus diisi.',
            'desa_id.required' => 'Desa harus dipilih.',
            'desa_id.exists' => 'Desa yang dipilih tidak valid.',
            'anggota.required' => 'Anggota ahli waris harus diisi.',
            'anggota.min' => 'Minimal harus ada satu anggota ahli waris.',
            'anggota.*.nama.required' => 'Nama anggota ahli waris harus diisi.',
            'anggota.*.nama.string' => 'Nama anggota ahli waris harus berupa teks.',
            'anggota.*.nama.max' => 'Nama anggota ahli waris maksimal 255 karakter.',
            'anggota.*.nik.required' => 'NIK anggota ahli waris harus diisi.',
            'anggota.*.nik.string' => 'NIK anggota ahli waris harus berupa teks.',
            'anggota.*.nik.max' => 'NIK anggota ahli waris maksimal 16 karakter.',
            'anggota.*.tempat_lahir.required' => 'Tempat lahir anggota ahli waris harus diisi.',
            'anggota.*.tempat_lahir.string' => 'Tempat lahir anggota ahli waris harus berupa teks.',
            'anggota.*.tempat_lahir.max' => 'Tempat lahir anggota ahli waris maksimal 255 karakter.',
            'anggota.*.tgl_lahir.required' => 'Tanggal lahir anggota ahli waris harus diisi.',
            'anggota.*.tgl_lahir.date' => 'Tanggal lahir anggota ahli waris tidak valid.',
            'anggota.*.jk.required' => 'Jenis kelamin anggota ahli waris harus dipilih.',
            'anggota.*.jk.in' => 'Jenis kelamin anggota ahli waris tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surat = Surat::where('jenis_surat', 'ahliwaris')->first();
        if (!$surat) {
            return redirect()->route('surat.ahliwaris.create')->with('error', 'Surat tidak ditemukan.');
        }

        $desa = Desa::find($request->input('desa_id'));
        if (!$desa) {
            return redirect()->route('surat.ahliwaris.create')->with('error', 'Desa tidak ditemukan.');
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
            'keperluan_ahliwaris' => $request->keperluan_ahliwaris,
        ]);
        $detailSurat->save();

        foreach ($request->anggota as $anggota) {
            AnggotaAhliWaris::create([
                'surat_penduduk_id' => $suratPenduduk->id,
                'nama' => $anggota['nama'],
                'nik' => $anggota['nik'],
                'tempat_lahir' => $anggota['tempat_lahir'],
                'tgl_lahir' => $anggota['tgl_lahir'],
                'jk' => $anggota['jk'],
            ]);
        }

        return redirect()->route('surat.ahliwaris.index')->with('success', 'Surat ahli waris berhasil disimpan.');
    }

    public function edit($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();
        $anggotaAhliwaris = $suratPenduduk->anggotaAhliwaris;
        $desas = Desa::all();
        return view('content.surat.ahliwaris.edit', compact('suratPenduduk', 'detailSurat', 'anggotaAhliwaris', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'keperluan_ahliwaris' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
            'anggota' => 'required|array|min:1',
            'anggota.*.nama' => 'required|string|max:255',
            'anggota.*.nik' => 'required|string|max:16',
            'anggota.*.tempat_lahir' => 'required|string|max:255',
            'anggota.*.tgl_lahir' => 'required|date',
            'anggota.*.jk' => 'required|in:Laki-laki,Perempuan',
        ], [
            'keperluan_ahliwaris.required' => 'Keperluan ahli waris harus diisi.',
            'desa_id.required' => 'Desa harus dipilih.',
            'desa_id.exists' => 'Desa yang dipilih tidak valid.',
            'anggota.required' => 'Anggota ahli waris harus diisi.',
            'anggota.min' => 'Minimal harus ada satu anggota ahli waris.',
            'anggota.*.nama.required' => 'Nama anggota ahli waris harus diisi.',
            'anggota.*.nama.string' => 'Nama anggota ahli waris harus berupa teks.',
            'anggota.*.nama.max' => 'Nama anggota ahli waris maksimal 255 karakter.',
            'anggota.*.nik.required' => 'NIK anggota ahli waris harus diisi.',
            'anggota.*.nik.string' => 'NIK anggota ahli waris harus berupa teks.',
            'anggota.*.nik.max' => 'NIK anggota ahli waris maksimal 16 karakter.',
            'anggota.*.tempat_lahir.required' => 'Tempat lahir anggota ahli waris harus diisi.',
            'anggota.*.tempat_lahir.string' => 'Tempat lahir anggota ahli waris harus berupa teks.',
            'anggota.*.tempat_lahir.max' => 'Tempat lahir anggota ahli waris maksimal 255 karakter.',
            'anggota.*.tgl_lahir.required' => 'Tanggal lahir anggota ahli waris harus diisi.',
            'anggota.*.tgl_lahir.date' => 'Tanggal lahir anggota ahli waris tidak valid.',
            'anggota.*.jk.required' => 'Jenis kelamin anggota ahli waris harus dipilih.',
            'anggota.*.jk.in' => 'Jenis kelamin anggota ahli waris tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $detailSurat = $suratPenduduk->detailSurats()->first();

        $detailSurat->update([
            'keperluan_ahliwaris' => $request->keperluan_ahliwaris,
        ]);

        AnggotaAhliWaris::where('surat_penduduk_id', $id)->delete();

        foreach ($request->anggota as $anggota) {
            AnggotaAhliWaris::create([
                'surat_penduduk_id' => $suratPenduduk->id,
                'nama' => $anggota['nama'],
                'nik' => $anggota['nik'],
                'tempat_lahir' => $anggota['tempat_lahir'],
                'tgl_lahir' => $anggota['tgl_lahir'],
                'jk' => $anggota['jk'],
            ]);
        }

        $suratPenduduk->update([
            'desa_id' => $request->desa_id,
        ]);

        return redirect()->route('surat.ahliwaris.index')->with('success', 'Surat ahli waris berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $suratPenduduk = SuratPenduduk::findOrFail($id);
        $suratPenduduk->delete();

        return redirect()->route('surat.ahliwaris.index')->with('success', 'Surat ahli waris berhasil dihapus.');
    }

    public function print($id)
    {
        $suratPenduduk = SuratPenduduk::with(['surat', 'detailSurats', 'anggotaAhliwaris', 'user.penduduk'])->findOrFail($id);
        return view('content.surat.ahliwaris.print', compact('suratPenduduk'));
    }
}
