<?php

namespace App\Http\Controllers;

use App\Models\DetailSurat;
use App\Models\Surat;
use App\Models\SuratPenduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuratController extends Controller
{
    public function create()
    {
        $surats = Surat::orderBy('created_at', 'desc')->get();
        return view('content.surat.create', compact('surats'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|string|max:255|unique:surats,no_surat',
            'nama_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|in:usaha,tidak_mampu,pindah,ahliwaris,tanah,rekomendasibbm,penghasilan',
        ], [
            'no_surat.required' => 'Nomor surat tidak boleh kosong.',
            'no_surat.unique' => 'Nomor surat sudah terdaftar.',
            'nama_surat.required' => 'Nama surat tidak boleh kosong.',
            'jenis_surat.required' => 'Jenis surat tidak boleh kosong.',
            'jenis_surat.in' => 'Jenis surat tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data surat
        Surat::create([
            'no_surat' => $request->no_surat,
            'nama_surat' => $request->nama_surat,
            'jenis_surat' => $request->jenis_surat,
        ]);

        return redirect()->route('surat.create')->with('success', 'Surat berhasil disimpan.');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('content.surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'no_surat' => 'required|string|max:255|unique:surats,no_surat,' . $surat->id,
            'nama_surat' => 'required|string|max:255',
            'jenis_surat' => 'required|in:usaha,tidak_mampu,pindah,ahliwaris,tanah,rekomendasibbm,penghasilan',
        ], [
            'no_surat.required' => 'Nomor surat tidak boleh kosong.',
            'no_surat.unique' => 'Nomor surat sudah terdaftar.',
            'nama_surat.required' => 'Nama surat tidak boleh kosong.',
            'jenis_surat.required' => 'Jenis surat tidak boleh kosong.',
            'jenis_surat.in' => 'Jenis surat tidak valid.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $surat->update([
            'no_surat' => $request->no_surat,
            'nama_surat' => $request->nama_surat,
            'jenis_surat' => $request->jenis_surat,
        ]);

        return redirect()->route('surat.create')->with('success', 'Surat berhasil diupdate.');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();

        return redirect()->route('surat.create')->with('success', 'Surat berhasil dihapus.');
    }

    public function createByJenis($jenis)
    {
        // Ambil surat berdasarkan jenis
        $surat = Surat::where('jenis_surat', $jenis)->first();
        if (!$surat) {
            return redirect()->route('surat.create')->with('error', 'Jenis surat tidak ditemukan.');
        }

        return view("content.surat.{$jenis}.create", compact('surat'));
    }

    public function getNoSurat($id)
    {
        $surat = Surat::find($id);
        if ($surat) {
            return response()->json(['no_surat' => $surat->no_surat]);
        }
        return response()->json(['error' => 'Surat not found'], 404);
    }
}
