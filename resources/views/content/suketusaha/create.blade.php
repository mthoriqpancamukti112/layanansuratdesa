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
                    <form action="{{ route('surat.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="jenis_surat" value="usaha">
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat:</label>
                            <input type="text" id="no_surat" name="no_surat"
                                class="form-control @error('no_surat') is-invalid @enderror" value="{{ old('no_surat') }}">
                            @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_usaha">Nama Usaha:</label>
                            <input type="text" id="nama_usaha" name="nama_usaha"
                                class="form-control @error('nama_usaha') is-invalid @enderror"
                                value="{{ old('nama_usaha') }}">
                            @error('nama_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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
                            <label for="berjalan_sejak">Usaha Berjalan Sejak:</label>
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
                        <button type="submit" class="btn btn-primary btn-block">Simpan Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
