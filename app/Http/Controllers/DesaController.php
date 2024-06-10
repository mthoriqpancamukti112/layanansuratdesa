<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function index()
    {
        $desas = Desa::orderBy('created_at', 'desc')->get();
        return view('content.desa.index', compact('desas'));
    }

    public function create()
    {
        return view('content.desa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'alamat_kantor' => 'required|string|max:255',
            'no_telp' => 'required|string|between:10,14',
            'email' => 'required|email',
            'kades' => 'required|string|max:255',
            'nip_kades' => 'required|string|max:18',
            'sekdes' => 'required|string|max:255',
            'nip_sekdes' => 'required|string|max:18',
            'bendahara' => 'required|string|max:255',
        ], [
            'image.required' => 'Gambar tidak boleh kosong.',
            'image.mimes' => 'File harus berformat PNG, JPG, atau JPEG.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'nama_desa.required' => 'Nama Desa harus diisi.',
            'kecamatan.required' => 'Kecamatan harus diisi.',
            'kabupaten.required' => 'Kabupaten harus diisi.',
            'provinsi.required' => 'Provinsi harus diisi.',
            'alamat_kantor.required' => 'Alamat Kantor harus diisi.',
            'no_telp.required' => 'Nomor Telepon harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'kades.required' => 'Nama Kepala Desa harus diisi.',
            'nip_kades.required' => 'NIP Kepala Desa harus diisi.',
            'sekdes.required' => 'Nama Sekretaris Desa harus diisi.',
            'nip_sekdes.required' => 'NIP Sekretaris Desa harus diisi.',
            'bendahara.required' => 'Nama Bendahara harus diisi.',
            'no_telp.between' => 'Nomor Telepon harus antara 10 hingga 14 karakter.',
            'nip_kades.max' => 'NIP Kepala Desa maksimal :max karakter.',
            'nip_sekdes.max' => 'NIP Sekretaris Desa maksimal :max karakter.',
        ]);

        $input = $request->all();

        // Upload gambar
        if ($image = $request->file('image')) {
            $destinationPath = public_path('image_desa');
            $postImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $postImage);
            $input['image'] = $postImage;
        }

        Desa::create($input);

        return redirect()->route('desa.index')->with('success', 'Desa created successfully.');
    }

    public function edit(Desa $desa)
    {
        return view('content.desa.edit', compact('desa'));
    }

    public function update(Request $request, Desa $desa)
    {
        $rules = [
            'nama_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string',
            'kabupaten' => 'required|string',
            'provinsi' => 'required|string',
            'alamat_kantor' => 'required|string',
            'no_telp' => 'required|string',
            'kades' => 'required|string|max:255',
            'nip_kades' => 'required|string',
            'sekdes' => 'required|string|max:255',
            'nip_sekdes' => 'required|string',
            'bendahara' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        $messages = [
            'nama_desa.required' => 'Nama desa wajib diisi.',
            'nama_desa.string' => 'Nama desa harus berupa teks.',
            'nama_desa.max' => 'Nama desa maksimal 255 karakter.',
            'kecamatan.required' => 'Kecamatan wajib diisi.',
            'kecamatan.string' => 'Kecamatan harus berupa teks.',
            'kabupaten.required' => 'Kabupaten wajib diisi.',
            'kabupaten.string' => 'Kabupaten harus berupa teks.',
            'provinsi.required' => 'Provinsi wajib diisi.',
            'provinsi.string' => 'Provinsi harus berupa teks.',
            'alamat_kantor.required' => 'Alamat kantor wajib diisi.',
            'alamat_kantor.string' => 'Alamat kantor harus berupa teks.',
            'no_telp.required' => 'No telp wajib diisi.',
            'no_telp.string' => 'No telp harus berupa teks.',
            'kades.required' => 'Nama Kades wajib diisi.',
            'kades.string' => 'Nama Kades harus berupa teks.',
            'kades.max' => 'Nama Kades maksimal 255 karakter.',
            'nip_kades.required' => 'NIP Kades wajib diisi.',
            'nip_kades.string' => 'NIP Kades harus berupa teks.',
            'sekdes.required' => 'Nama Sekdes wajib diisi.',
            'sekdes.string' => 'Nama Sekdes harus berupa teks.',
            'sekdes.max' => 'Nama Sekdes maksimal 255 karakter.',
            'nip_sekdes.required' => 'NIP Sekdes wajib diisi.',
            'nip_sekdes.string' => 'NIP Sekdes harus berupa teks.',
            'bendahara.required' => 'Nama Bendahara wajib diisi.',
            'bendahara.string' => 'Nama Bendahara harus berupa teks.',
            'bendahara.max' => 'Nama Bendahara maksimal 255 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan: jpg, jpeg, png.',
            'image.max' => 'Ukuran gambar maksimal 2 MB.',
        ];

        $request->validate($rules, $messages);

        // Mengelola gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($desa->image && file_exists(public_path('image_desa/' . $desa->image))) {
                unlink(public_path('image_desa/' . $desa->image));
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('image_desa'), $imageName);
            $desa->image = $imageName;
        }

        // Update data desa
        $desa->nama_desa = $request->nama_desa;
        $desa->kecamatan = $request->kecamatan;
        $desa->kabupaten = $request->kabupaten;
        $desa->provinsi = $request->provinsi;
        $desa->alamat_kantor = $request->alamat_kantor;
        $desa->no_telp = $request->no_telp;
        $desa->kades = $request->kades;
        $desa->nip_kades = $request->nip_kades;
        $desa->sekdes = $request->sekdes;
        $desa->nip_sekdes = $request->nip_sekdes;
        $desa->bendahara = $request->bendahara;
        $desa->save();

        return redirect()->route('desa.index')->with('success', 'Data desa berhasil diupdate.');
    }

    public function destroy(Desa $desa)
    {
        $desa->delete();

        return redirect()->route('desa.index')->with('success', 'Desa deleted successfully.');
    }
}
