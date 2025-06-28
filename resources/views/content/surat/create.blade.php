@extends('layout.be.template')
@section('title', 'Buat Surat')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat:</label>
                            <input type="text" id="no_surat" name="no_surat"
                                class="form-control @error('no_surat') is-invalid @enderror" value="{{ old('no_surat') }}">
                            @error('no_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_surat">Nama Surat:</label>
                            <input type="text" id="nama_surat" name="nama_surat"
                                class="form-control @error('nama_surat') is-invalid @enderror"
                                value="{{ old('nama_surat') }}">
                            @error('nama_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_surat">Jenis Surat:</label>
                            <select id="jenis_surat" name="jenis_surat"
                                class="form-control @error('jenis_surat') is-invalid @enderror">
                                <option value="">Pilih Jenis Surat</option>
                                <option value="usaha" {{ old('jenis_surat') == 'usaha' ? 'selected' : '' }}>Suket Usaha
                                </option>
                                <option value="tidak_mampu" {{ old('jenis_surat') == 'tidak_mampu' ? 'selected' : '' }}>
                                    Suket Tidak Mampu</option>
                                <option value="pindah" {{ old('jenis_surat') == 'pindah' ? 'selected' : '' }}>Suket Pindah
                                </option>
                                <option value="ahliwaris" {{ old('jenis_surat') == 'ahliwaris' ? 'selected' : '' }}>Suket
                                    Ahli Waris</option>
                                <option value="tanah" {{ old('jenis_surat') == 'tanah' ? 'selected' : '' }}>Suket Tanah
                                </option>
                                <option value="rekomendasibbm"
                                    {{ old('jenis_surat') == 'rekomendasibbm' ? 'selected' : '' }}>Surat Rekomendasi BBM
                                </option>
                                <option value="penghasilan" {{ old('jenis_surat') == 'penghasilan' ? 'selected' : '' }}>
                                    Surat Penghasilan Orang Tua
                                </option>
                            </select>
                            @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Surat</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2">
        <div class="card-header">
            <h4>Daftar Surat</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>Nama Surat</th>
                            <th>Jenis Surat</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surats as $surat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->nama_surat }}</td>
                                <td>{{ ucfirst($surat->jenis_surat) }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('surat.edit', $surat->id) }}"
                                            class="btn btn-primary mr-2">Edit</a>
                                        {{-- <form action="{{ route('surat.destroy', $surat->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mr-2"
                                                onclick="return confirm('Apakah anda yakin ingin hapus?')">Delete</button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
