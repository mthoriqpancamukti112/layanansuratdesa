<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    public function index()
    {

        $permohonanSurats = PermohonanSurat::orderBy('created_at', 'desc')->get();
        return view('content.permohonansurat.index', compact('permohonanSurats'));
    }

    public function create()
    {
        $permohonanSurat = PermohonanSurat::orderBy('created_at', 'desc')->get();
        return view('content.permohonansurat.create', compact('permohonanSurat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|max:20',
            'nama' => 'required|string|max:255',
            'jenis_surat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'upload' => 'required|mimes:pdf|max:2048',
            'tgl_buat' => 'nullable|date',
        ], [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.max' => 'NIK tidak boleh lebih dari :max karakter.',
            'nama.required' => 'Nama tidak boleh kosong.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari :max karakter.',
            'jenis_surat.required' => 'Jenis surat tidak boleh kosong.',
            'jenis_surat.string' => 'Jenis surat harus berupa teks.',
            'jenis_surat.max' => 'Jenis surat tidak boleh lebih dari :max karakter.',
            'no_hp.required' => 'Nomor HP tidak boleh kosong.',
            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari :max karakter.',
            'foto.required' => 'Foto tidak boleh kosong.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'File foto harus berformat jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran file foto tidak boleh lebih dari 2MB.',
            'upload.required' => 'Upload berkas tidak boleh kosong.',
            'upload.mimes' => 'File upload harus berformat pdf.',
            'upload.max' => 'Ukuran berkas upload tidak boleh lebih dari 2MB.',
        ]);

        // Menangani upload foto
        if ($image = $request->file('foto')) {
            $destinationPath = public_path('foto');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['foto'] = "$postImage";
        }

        // Menangani upload berkas PDF
        if ($file = $request->file('upload')) {
            $destinationPath = public_path('berkas_permohonan_surat');
            $fileName = date('YmdHis') . "." . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $input['upload'] = "$fileName";
        }

        // Simpan data
        $permohonanSurat = new PermohonanSurat();
        $permohonanSurat->nik = $request->nik;
        $permohonanSurat->nama = $request->nama;
        $permohonanSurat->jenis_surat = $request->jenis_surat;
        $permohonanSurat->no_hp = $request->no_hp;
        $permohonanSurat->foto = $postImage ?? null;
        $permohonanSurat->upload = $fileName ?? null;
        $permohonanSurat->tgl_buat = now();
        $permohonanSurat->status = 'diproses';
        $permohonanSurat->save();

        return redirect()->back()->with('success', 'Permohonan surat berhasil disimpan. Harap tunggu konfirmasi dari admin.');
    }

    public function acc($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);
        $permohonanSurat->status = 'disetujui';
        $permohonanSurat->save();

        return redirect()->route('daftarbuatpermohonan.index')->with('success', 'Permohonan surat berhasil disetujui.');
    }

    public function destroy($id)
    {
        $permohonanSurat = PermohonanSurat::findOrFail($id);

        // Hapus file foto dan upload jika ada
        if ($permohonanSurat->foto) {
            unlink(public_path('foto/' . $permohonanSurat->foto));
        }
        if ($permohonanSurat->upload) {
            unlink(public_path('berkas_permohonan_surat/' . $permohonanSurat->upload));
        }

        $permohonanSurat->delete();

        return redirect()->route('daftarbuatpermohonan.index')->with('success', 'Permohonan surat berhasil dihapus.');
    }
}
