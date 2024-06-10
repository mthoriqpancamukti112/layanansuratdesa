@extends('layout.be.template')
@section('title', 'Buat Surat Rekomendasi BBM')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat Rekomendasi BBM</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.rekomendasibbm.store') }}" method="POST">
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
                                    <label for="no_surat">Nomor Surat:</label>
                                    <input type="text" id="no_surat" name="no_surat"
                                        class="form-control @error('no_surat') is-invalid @enderror"
                                        value="{{ $surat->no_surat }}" readonly>
                                    @error('no_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_surat">Nama Surat:</label>
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
                                    <label for="nama_usaha_rekomendasibbm">Nama Usaha:</label>
                                    <input type="text" id="nama_usaha_rekomendasibbm" name="nama_usaha_rekomendasibbm"
                                        class="form-control @error('nama_usaha_rekomendasibbm') is-invalid @enderror"
                                        value="{{ old('nama_usaha_rekomendasibbm') }}">
                                    @error('nama_usaha_rekomendasibbm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="konsumen_pengguna">Konsumen Pengguna:</label>
                                    <input type="text" id="konsumen_pengguna" name="konsumen_pengguna"
                                        class="form-control @error('konsumen_pengguna') is-invalid @enderror"
                                        value="{{ old('konsumen_pengguna') }}">
                                    @error('konsumen_pengguna')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis_usaha">Jenis Usaha:</label>
                                    <input type="text" id="jenis_usaha" name="jenis_usaha"
                                        class="form-control @error('jenis_usaha') is-invalid @enderror"
                                        value="{{ old('jenis_usaha') }}">
                                    @error('jenis_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jenis_alat">Jenis Alat:</label>
                                    <input type="text" id="jenis_alat" name="jenis_alat"
                                        class="form-control @error('jenis_alat') is-invalid @enderror"
                                        value="{{ old('jenis_alat') }}">
                                    @error('jenis_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fungsi">Fungsi:</label>
                                    <input type="text" id="fungsi" name="fungsi"
                                        class="form-control @error('fungsi') is-invalid @enderror"
                                        value="{{ old('fungsi') }}">
                                    @error('fungsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_alat">Jumlah Alat:</label>
                                    <input type="number" id="jumlah_alat" name="jumlah_alat"
                                        class="form-control @error('jumlah_alat') is-invalid @enderror"
                                        value="{{ old('jumlah_alat') }}">
                                    @error('jumlah_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="daya_alat">Daya Alat:</label>
                                    <input type="text" id="daya_alat" name="daya_alat"
                                        class="form-control @error('daya_alat') is-invalid @enderror"
                                        value="{{ old('daya_alat') }}">
                                    @error('daya_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lama_penggunaan">Lama Penggunaan:</label>
                                    <input type="text" id="lama_penggunaan" name="lama_penggunaan"
                                        class="form-control @error('lama_penggunaan') is-invalid @enderror"
                                        value="{{ old('lama_penggunaan') }}">
                                    @error('lama_penggunaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="lama_operasi_alat">Lama Operasi Alat:</label>
                                    <input type="text" id="lama_operasi_alat" name="lama_operasi_alat"
                                        class="form-control @error('lama_operasi_alat') is-invalid @enderror"
                                        value="{{ old('lama_operasi_alat') }}">
                                    @error('lama_operasi_alat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="konsumsi">Konsumsi:</label>
                                    <input type="text" id="konsumsi" name="konsumsi"
                                        class="form-control @error('konsumsi') is-invalid @enderror"
                                        value="{{ old('konsumsi') }}">
                                    @error('konsumsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alat_pembelian_digunakan">Alat Pembelian Digunakan:</label>
                                    <input type="text" id="alat_pembelian_digunakan" name="alat_pembelian_digunakan"
                                        class="form-control @error('alat_pembelian_digunakan') is-invalid @enderror"
                                        value="{{ old('alat_pembelian_digunakan') }}">
                                    @error('alat_pembelian_digunakan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 btn-block">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
