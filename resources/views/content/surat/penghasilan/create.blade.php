@extends('layout.be.template')
@section('title', 'Buat Surat Penghasilan Orang Tua')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat Penghasilan Orang Tua</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.penghasilan.store', 'penghasilan') }}" method="POST">
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
                                    <label for="jumlah_penghasilan">Jumlah Penghasilan</label>
                                    <input type="number" id="jumlah_penghasilan" name="jumlah_penghasilan"
                                        class="form-control @error('jumlah_penghasilan') is-invalid @enderror"
                                        value="{{ old('jumlah_penghasilan') }}" placeholder="ex: kurang dari Rp. ">
                                    @error('jumlah_penghasilan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keperluan">Keperluan</label>
                                    <input type="text" id="keperluan" name="keperluan"
                                        class="form-control @error('keperluan') is-invalid @enderror"
                                        value="{{ old('keperluan') }}">
                                    @error('keperluan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Simpan Surat</button>
                        <a href="{{ route('surat.penghasilan.index') }}" type="button"
                            class="btn btn-danger btn-block">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
