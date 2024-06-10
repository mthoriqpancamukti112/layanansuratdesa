@extends('layout.be.template')
@section('title', 'Edit Data Desa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>EDIT DATA DESA</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form action="{{ route('desa.update', $desa->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <br>
                            @if ($desa->image)
                                <img src="/image_desa/{{ $desa->image }}" alt="{{ $desa->nama_desa }}" width="150px"
                                    class="mt-2">
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Nama Desa</label>
                            <input type="text" name="nama_desa"
                                class="form-control @error('nama_desa') is-invalid @enderror"
                                value="{{ old('nama_desa', $desa->nama_desa) }}">
                            @error('nama_desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi"
                                class="form-control @error('provinsi') is-invalid @enderror"
                                value="{{ old('provinsi', $desa->provinsi) }}">
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten"
                                class="form-control @error('kabupaten') is-invalid @enderror"
                                value="{{ old('kabupaten', $desa->kabupaten) }}">
                            @error('kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan"
                                class="form-control @error('kecamatan') is-invalid @enderror"
                                value="{{ old('kecamatan', $desa->kecamatan) }}">
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat Kantor</label>
                            <textarea name="alamat_kantor" class="form-control @error('alamat_kantor') is-invalid @enderror">{{ old('alamat_kantor', $desa->alamat_kantor) }}</textarea>
                            @error('alamat_kantor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>No Telp</label>
                            <input type="text" name="no_telp" class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp', $desa->no_telp) }}">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $desa->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kades</label>
                            <input type="text" name="kades" class="form-control @error('kades') is-invalid @enderror"
                                value="{{ old('kades', $desa->kades) }}">
                            @error('kades')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>NIP Kades</label>
                            <input type="text" name="nip_kades"
                                class="form-control @error('nip_kades') is-invalid @enderror"
                                value="{{ old('nip_kades', $desa->nip_kades) }}">
                            @error('nip_kades')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Sekdes</label>
                            <input type="text" name="sekdes" class="form-control @error('sekdes') is-invalid @enderror"
                                value="{{ old('sekdes', $desa->sekdes) }}">
                            @error('sekdes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>NIP Sekdes</label>
                            <input type="text" name="nip_sekdes"
                                class="form-control @error('nip_sekdes') is-invalid @enderror"
                                value="{{ old('nip_sekdes', $desa->nip_sekdes) }}">
                            @error('nip_sekdes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Bendahara</label>
                            <input type="text" name="bendahara"
                                class="form-control @error('bendahara') is-invalid @enderror"
                                value="{{ old('bendahara', $desa->bendahara) }}">
                            @error('bendahara')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
        </form>
    </div>
@endsection
