@extends('layout.be.template')
@section('title', 'Buat Surat Usaha')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat Usaha</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.usaha.store', 'usaha') }}" method="POST">
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
                                    <label for="bidang_usaha">Bidang Usaha:</label>
                                    <input type="text" id="bidang_usaha" name="bidang_usaha"
                                        class="form-control @error('bidang_usaha') is-invalid @enderror"
                                        value="{{ old('bidang_usaha') }}">
                                    @error('bidang_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="berjalan_sejak">Berjalan Sejak:</label>
                                    <input type="date" id="berjalan_sejak" name="berjalan_sejak"
                                        class="form-control @error('berjalan_sejak') is-invalid @enderror"
                                        value="{{ old('berjalan_sejak') }}">
                                    @error('berjalan_sejak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="alamat_usaha">Alamat Usaha:</label>
                                    <textarea id="alamat_usaha" name="alamat_usaha" class="form-control @error('alamat_usaha') is-invalid @enderror">{{ old('alamat_usaha') }}</textarea>
                                    @error('alamat_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_usaha_skusaha">Nama Usaha:</label>
                                    <input type="text" id="nama_usaha_skusaha" name="nama_usaha_skusaha"
                                        class="form-control @error('nama_usaha_skusaha') is-invalid @enderror"
                                        value="{{ old('nama_usaha_skusaha') }}">
                                    @error('nama_usaha_skusaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Surat</button>
                        <a href="{{ route('surat.usaha.index') }}" type="button"
                            class="btn btn-danger btn-block">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
