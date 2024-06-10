@extends('layout.be.template')
@section('title', 'Buat Surat Ahli Waris')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card-header">
                    <h4>Buat Surat Ahli Waris</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.ahliwaris.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="no_surat">Nomor Surat</label>
                            <input type="text" class="form-control" id="no_surat" name="no_surat"
                                value="{{ $surat->no_surat }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jenis_surat">Jenis Surat</label>
                            <input type="text" class="form-control" id="jenis_surat" name="jenis_surat"
                                value="{{ $surat->jenis_surat }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="desa_id">Desa</label>
                            <select name="desa_id" id="desa_id"
                                class="form-control @error('desa_id') is-invalid @enderror">
                                <option value="">-- Pilih Desa --</option>
                                @foreach ($desas as $desa)
                                    <option value="{{ $desa->id }}" {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama_desa }}
                                    </option>
                                @endforeach
                            </select>
                            @error('desa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="keperluan_ahliwaris">Keperluan Ahli Waris</label>
                            <textarea class="form-control @error('keperluan_ahliwaris') is-invalid @enderror" id="keperluan_ahliwaris"
                                name="keperluan_ahliwaris" rows="3">{{ old('keperluan_ahliwaris') }}</textarea>
                            @error('keperluan_ahliwaris')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Anggota Ahli Waris</h5>
                            <div id="anggota-container">
                                <div class="anggota-item">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <input type="text"
                                                class="form-control @error('anggota.0.nama') is-invalid @enderror"
                                                name="anggota[0][nama]" placeholder="Nama">
                                            @error('anggota.0.nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number"
                                                class="form-control @error('anggota.0.nik') is-invalid @enderror"
                                                name="anggota[0][nik]" placeholder="NIK">
                                            @error('anggota.0.nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text"
                                                class="form-control @error('anggota.0.tempat_lahir') is-invalid @enderror"
                                                name="anggota[0][tempat_lahir]" placeholder="Tempat Lahir">
                                            @error('anggota.0.tempat_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="date"
                                                class="form-control @error('anggota.0.tgl_lahir') is-invalid @enderror"
                                                name="anggota[0][tgl_lahir]">
                                            @error('anggota.0.tgl_lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control @error('anggota.0.jk') is-invalid @enderror"
                                                name="anggota[0][jk]">
                                                <option value="">Jenis Kelamin</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                            @error('anggota.0.jk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button type="button" class="btn btn-success btn-sm add-anggota">Tambah
                                                Anggota</button>
                                        </div>
                                    </div>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            var maxFields = 10;
            var wrapper = $("#anggota-container");
            var addButton = $(".add-anggota");
            var x = 1;

            $(addButton).click(function(e) {
                e.preventDefault();
                if (x < maxFields) {
                    x++;
                    $(wrapper).append(
                        '<div class="anggota-item mt-3"><div class="form-row"><div class="col-md-3"><input type="text" class="form-control" name="anggota[' +
                        x +
                        '][nama]" placeholder="Nama"></div><div class="col-md-3"><input type="text" class="form-control" name="anggota[' +
                        x +
                        '][nik]" placeholder="NIK"></div><div class="col-md-3"><input type="text" class="form-control" name="anggota[' +
                        x +
                        '][tempat_lahir]" placeholder="Tempat Lahir"></div><div class="col-md-2"><input type="date" class="form-control" name="anggota[' +
                        x +
                        '][tgl_lahir]"></div><div class="col-md-1"><select class="form-control" name="anggota[' +
                        x +
                        '][jk]"><option value="">Jenis Kelamin</option><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div><div class="col-12 mt-2"><button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button></div></div></div>'
                    );
                }
            });

            $(wrapper).on("click", ".remove-anggota", function(e) {
                e.preventDefault();
                $(this).closest('.anggota-item').remove();
                x--;
            });
        });
    </script>
@endsection
