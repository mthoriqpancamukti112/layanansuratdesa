@extends('layout.be.template')
@section('title', 'Edit Surat')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Surat</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.update', $surat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat:</label>
                            <input type="text" id="no_surat" name="no_surat"
                                class="form-control @error('no_surat') is-invalid @enderror"
                                value="{{ old('no_surat', $surat->no_surat) }}">
                            @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_surat">Nama Surat:</label>
                            <input type="text" id="nama_surat" name="nama_surat"
                                class="form-control @error('nama_surat') is-invalid @enderror"
                                value="{{ old('nama_surat', $surat->nama_surat) }}" readonly>
                            @error('nama_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_surat">Jenis Surat (jangan diubah)</label>
                            <select id="jenis_surat" name="jenis_surat"
                                class="form-control @error('jenis_surat') is-invalid @enderror">
                                <option value="">Pilih Jenis Surat</option>
                                <option value="usaha"
                                    {{ old('jenis_surat', $surat->jenis_surat) == 'usaha' ? 'selected' : '' }}>Suket Usaha
                                </option>
                                <option value="tidak_mampu"
                                    {{ old('jenis_surat', $surat->jenis_surat) == 'tidak_mampu' ? 'selected' : '' }}>
                                    Suket Tidak Mampu</option>
                                <option value="pindah"
                                    {{ old('jenis_surat', $surat->jenis_surat) == 'pindah' ? 'selected' : '' }}>Suket Pindah
                                </option>
                                <option value="ahliwaris"
                                    {{ old('jenis_surat', $surat->jenis_surat) == 'ahliwaris' ? 'selected' : '' }}>Suket
                                    Ahli
                                    Waris</option>
                                <option value="tanah"
                                    {{ old('jenis_surat', $surat->jenis_surat) == 'tanah' ? 'selected' : '' }}>Suket Tanah
                                </option>
                                <option value="rekomendasibbm"
                                    {{ old('jenis_surat', $surat->jenis_surat) == 'rekomendasibbm' ? 'selected' : '' }}>
                                    Surat Rekomendasi BBM
                                </option>
                            </select>
                            @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update Surat</button>
                        <a href="{{ route('surat.create') }}" type="button" class="btn btn-danger btn-block">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
