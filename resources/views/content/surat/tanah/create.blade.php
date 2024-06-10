@extends('layout.be.template')
@section('title', 'Buat Surat Tanah')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat Tanah</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.tanah.store') }}" method="POST">
                        @csrf
                        <div class="d-flex flex-column flex-md-row justify-content-center">
                            <div class="flex-fill pr-2">
                                <div class="form-group">
                                    <label for="desa_id">Desa</label>
                                    <select name="desa_id" id="desa_id"
                                        class="form-control @error('desa_id') is-invalid @enderror">
                                        <option value="">-- Pilih Desa --</option>
                                        @foreach ($desas as $desa)
                                            <option value="{{ $desa->id }}"
                                                {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                                {{ $desa->nama_desa }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('desa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="no_surat">Nomor Surat</label>
                                    <input type="text" id="no_surat" name="no_surat"
                                        class="form-control @error('no_surat') is-invalid @enderror"
                                        value="{{ $surat->no_surat }}" readonly>
                                    @error('no_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_surat">Nama Surat</label>
                                    <input type="text" id="nama_surat" name="nama_surat"
                                        class="form-control @error('nama_surat') is-invalid @enderror"
                                        value="{{ $surat->nama_surat }}" readonly>
                                    @error('nama_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex-fill pl-2">
                                <div class="form-group">
                                    <label for="dusun">Dusun</label>
                                    <input type="text" id="dusun" name="dusun"
                                        class="form-control @error('dusun') is-invalid @enderror"
                                        value="{{ old('dusun') }}">
                                    @error('dusun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_desa_sktanah">Nama Desa</label>
                                    <input type="text" id="nama_desa_sktanah" name="nama_desa_sktanah"
                                        class="form-control @error('nama_desa_sktanah') is-invalid @enderror"
                                        value="{{ old('nama_desa_sktanah') }}">
                                    @error('nama_desa_sktanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan_sktanah">Kecamatan</label>
                                    <input type="text" id="kecamatan_sktanah" name="kecamatan_sktanah"
                                        class="form-control @error('kecamatan_sktanah') is-invalid @enderror"
                                        value="{{ old('kecamatan_sktanah') }}">
                                    @error('kecamatan_sktanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kabupaten_sktanah">Kabupaten</label>
                                    <input type="text" id="kabupaten_sktanah" name="kabupaten_sktanah"
                                        class="form-control @error('kabupaten_sktanah') is-invalid @enderror"
                                        value="{{ old('kabupaten_sktanah') }}">
                                    @error('kabupaten_sktanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row justify-content-center">
                            <div class="flex-fill pr-2">
                                <div class="form-group">
                                    <label for="luas_tanah">Luas Tanah (m&#178;)</label>
                                    <input type="number" id="luas_tanah" name="luas_tanah"
                                        class="form-control @error('luas_tanah') is-invalid @enderror"
                                        value="{{ old('luas_tanah') }}">
                                    @error('luas_tanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="status_tanah">Status Tanah</label>
                                    <input type="text" id="status_tanah" name="status_tanah"
                                        class="form-control @error('status_tanah') is-invalid @enderror"
                                        value="{{ old('status_tanah') }}">
                                    @error('status_tanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="digunakan_untuk">Digunakan Untuk</label>
                                    <input type="text" id="digunakan_untuk" name="digunakan_untuk"
                                        class="form-control @error('digunakan_untuk') is-invalid @enderror"
                                        value="{{ old('digunakan_untuk') }}">
                                    @error('digunakan_untuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cara_memperoleh">Cara Memperoleh</label>
                                    <input type="text" id="cara_memperoleh" name="cara_memperoleh"
                                        class="form-control @error('cara_memperoleh') is-invalid @enderror"
                                        value="{{ old('cara_memperoleh') }}">
                                    @error('cara_memperoleh')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="flex-fill pl-2">
                                <div class="form-group">
                                    <label for="batas_utara">Sandingan Sebelah Utara</label>
                                    <input type="text" id="batas_utara" name="batas_utara"
                                        class="form-control @error('batas_utara') is-invalid @enderror"
                                        value="{{ old('batas_utara') }}">
                                    @error('batas_utara')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="batas_timur">Sandingan Sebelah Timur</label>
                                    <input type="text" id="batas_timur" name="batas_timur"
                                        class="form-control @error('batas_timur') is-invalid @enderror"
                                        value="{{ old('batas_timur') }}">
                                    @error('batas_timur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="batas_selatan">Sandingan Sebelah Selatan</label>
                                    <input type="text" id="batas_selatan" name="batas_selatan"
                                        class="form-control @error('batas_selatan') is-invalid @enderror"
                                        value="{{ old('batas_selatan') }}">
                                    @error('batas_selatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="batas_barat">Sandingan Sebelah Barat</label>
                                    <input type="text" id="batas_barat" name="batas_barat"
                                        class="form-control @error('batas_barat') is-invalid @enderror"
                                        value="{{ old('batas_barat') }}">
                                    @error('batas_barat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keperluan_sktanah">Keperluan</label>
                                    <textarea id="keperluan_sktanah" name="keperluan_sktanah"
                                        class="form-control @error('keperluan_sktanah') is-invalid @enderror">{{ old('keperluan_sktanah') }}</textarea>
                                    @error('keperluan_sktanah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
