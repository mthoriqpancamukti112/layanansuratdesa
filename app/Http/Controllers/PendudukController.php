<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    public function index()
    {
        $penduduk = Penduduk::with('user')->orderBy('created_at', 'desc')->get();
        return view('content.penduduk.index', compact('penduduk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kk' => 'required|string|max:20',
            'jk' => 'required|string|max:10',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'kewarganegaraan' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'status' => 'required|string|max:50',
            'pendidikan' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'provinsi' => 'required|string|max:100',
            'kabupaten' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'desa' => 'required|string|max:100',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
        ], [
            'no_kk.required' => 'Nomor KK tidak boleh kosong.',
            'no_kk.max' => 'Nomor KK tidak boleh lebih dari :max karakter.',
            'jk.required' => 'Jenis kelamin tidak boleh kosong.',
            'jk.max' => 'Jenis kelamin tidak boleh lebih dari :max karakter.',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong.',
            'tempat_lahir.max' => 'Tempat lahir tidak boleh lebih dari :max karakter.',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong.',
            'tgl_lahir.date' => 'Format tanggal lahir tidak valid.',
            'kewarganegaraan.required' => 'Kewarganegaraan tidak boleh kosong.',
            'kewarganegaraan.max' => 'Kewarganegaraan tidak boleh lebih dari :max karakter.',
            'agama.required' => 'Agama tidak boleh kosong.',
            'agama.max' => 'Agama tidak boleh lebih dari :max karakter.',
            'status.required' => 'Status tidak boleh kosong.',
            'status.max' => 'Status tidak boleh lebih dari :max karakter.',
            'pendidikan.required' => 'Pendidikan tidak boleh kosong.',
            'pendidikan.max' => 'Pendidikan tidak boleh lebih dari :max karakter.',
            'pekerjaan.max' => 'Pekerjaan tidak boleh lebih dari :max karakter.',
            'provinsi.required' => 'Provinsi tidak boleh kosong.',
            'provinsi.max' => 'Provinsi tidak boleh lebih dari :max karakter.',
            'kabupaten.required' => 'Kabupaten tidak boleh kosong.',
            'kabupaten.max' => 'Kabupaten tidak boleh lebih dari :max karakter.',
            'kecamatan.required' => 'Kecamatan tidak boleh kosong.',
            'kecamatan.max' => 'Kecamatan tidak boleh lebih dari :max karakter.',
            'desa.required' => 'Desa tidak boleh kosong.',
            'desa.max' => 'Desa tidak boleh lebih dari :max karakter.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari :max karakter.',
        ]);

        $penduduk = new Penduduk();
        $penduduk->no_kk = $request->no_kk;
        $penduduk->jk = $request->jk;
        $penduduk->tempat_lahir = $request->tempat_lahir;
        $penduduk->tgl_lahir = $request->tgl_lahir;
        $penduduk->kewarganegaraan = $request->kewarganegaraan;
        $penduduk->agama = $request->agama;
        $penduduk->status = $request->status;
        $penduduk->pendidikan = $request->pendidikan;
        $penduduk->pekerjaan = $request->pekerjaan;
        $penduduk->provinsi = $request->provinsi;
        $penduduk->kabupaten = $request->kabupaten;
        $penduduk->kecamatan = $request->kecamatan;
        $penduduk->desa = $request->desa;
        $penduduk->alamat = $request->alamat;
        $penduduk->no_hp = $request->no_hp;
        $penduduk->save();

        return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil ditambahkan.');
    }

    public function destroy(Penduduk $penduduk)
    {
        try {
            $penduduk->delete();
            return redirect()->route('penduduk.index')->with('success', 'Penduduk berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('penduduk.index')->with('error', 'Terjadi kesalahan saat menghapus penduduk: ' . $e->getMessage());
        }
    }
}
