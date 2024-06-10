@extends('layout.be.template')
@section('title', 'Buat Surat Tidak Mampu')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat Tidak Mampu</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.tidakmampu.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <label for="keperluan_tidakmampu">Keperluan Tidak Mampu:</label>
                                    <textarea id="keperluan_tidakmampu" name="keperluan_tidakmampu"
                                        class="form-control @error('keperluan_tidakmampu') is-invalid @enderror">{{ old('keperluan_tidakmampu') }}</textarea>
                                    @error('keperluan_tidakmampu')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="upload_kk">Upload KK:</label>
                                    <input type="file" id="upload_kk" name="upload_kk"
                                        class="form-control-file @error('upload_kk') is-invalid @enderror">
                                    @error('upload_kk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="upload_ktp">Upload KTP:</label>
                                    <input type="file" id="upload_ktp" name="upload_ktp"
                                        class="form-control-file @error('upload_ktp') is-invalid @enderror">
                                    @error('upload_ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Surat</button>
                        <a href="{{ route('surat.tidakmampu.index') }}" class="btn btn-danger btn-block">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
