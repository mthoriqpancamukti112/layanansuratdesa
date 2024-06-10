@extends('layout.be.template')
@section('title', 'Buat Surat Pindah')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Buat Surat Pindah</h4>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('surat.pindah.store') }}" method="POST">
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
                            <label for="alasan_pindah">Alasan Pindah</label>
                            <select class="form-control @error('alasan_pindah') is-invalid @enderror" id="alasan_pindah"
                                name="alasan_pindah">
                                <option value="">-- Pilih Alasan --</option>
                                <option value="Pekerjaan" {{ old('alasan_pindah') == 'Pekerjaan' ? 'selected' : '' }}>
                                    Pekerjaan</option>
                                <option value="Pendidikan" {{ old('alasan_pindah') == 'Pendidikan' ? 'selected' : '' }}>
                                    Pendidikan</option>
                                <option value="Keamanan" {{ old('alasan_pindah') == 'Keamanan' ? 'selected' : '' }}>
                                    Keamanan
                                </option>
                                <option value="Kesehatan" {{ old('alasan_pindah') == 'Kesehatan' ? 'selected' : '' }}>
                                    Kesehatan</option>
                                <option value="Perumahan" {{ old('alasan_pindah') == 'Perumahan' ? 'selected' : '' }}>
                                    Perumahan</option>
                                <option value="Keluarga" {{ old('alasan_pindah') == 'Keluarga' ? 'selected' : '' }}>
                                    Keluarga
                                </option>
                                <option value="Pindah tempat tinggal"
                                    {{ old('alasan_pindah') == 'Pindah tempat tinggal' ? 'selected' : '' }}>Pindah Tempat
                                    Tinggal</option>
                            </select>
                            @error('alasan_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="alamat_tujuan_pindah">Alamat Tujuan Pindah</label>
                            <input type="text" class="form-control @error('alamat_tujuan_pindah') is-invalid @enderror"
                                id="alamat_tujuan_pindah" name="alamat_tujuan_pindah"
                                value="{{ old('alamat_tujuan_pindah') }}">
                            @error('alamat_tujuan_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nama_desa_pindah">Desa</label>
                            <input type="text" class="form-control @error('nama_desa_pindah') is-invalid @enderror"
                                id="nama_desa_pindah" name="nama_desa_pindah" value="{{ old('nama_desa_pindah') }}">
                            @error('nama_desa_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kecamatan_pindah">Kecamatan</label>
                            <input type="text" class="form-control @error('kecamatan_pindah') is-invalid @enderror"
                                id="kecamatan_pindah" name="kecamatan_pindah" value="{{ old('kecamatan_pindah') }}">
                            @error('kecamatan_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kabupaten_pindah">Kabupaten</label>
                            <input type="text" class="form-control @error('kabupaten_pindah') is-invalid @enderror"
                                id="kabupaten_pindah" name="kabupaten_pindah" value="{{ old('kabupaten_pindah') }}">
                            @error('kabupaten_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="provinsi_pindah">Provinsi</label>
                            <input type="text" class="form-control @error('provinsi_pindah') is-invalid @enderror"
                                id="provinsi_pindah" name="provinsi_pindah" value="{{ old('provinsi_pindah') }}">
                            @error('provinsi_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                name="no_telp" value="{{ old('no_telp') }}">
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="kode_pos">Kode Pos</label>
                            <input type="number" class="form-control @error('kode_pos') is-invalid @enderror"
                                id="kode_pos" name="kode_pos" value="{{ old('kode_pos') }}">
                            @error('kode_pos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rt">RT</label>
                            <input type="number" class="form-control @error('rt') is-invalid @enderror" id="rt"
                                name="rt" value="{{ old('rt') }}">
                            @error('rt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rw">RW</label>
                            <input type="number" class="form-control @error('rw') is-invalid @enderror" id="rw"
                                name="rw" value="{{ old('rw') }}">
                            @error('rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="klasifikasi_pindah">Klasifikasi Pindah</label>
                            <select class="form-control @error('klasifikasi_pindah') is-invalid @enderror"
                                id="klasifikasi_pindah" name="klasifikasi_pindah">
                                <option value="">-- Pilih Klasifikasi --</option>
                                <option value="Dalam Satu Desa/Kelurahan"
                                    {{ old('klasifikasi_pindah') == 'Dalam Satu Desa/Kelurahan' ? 'selected' : '' }}>Dalam
                                    Satu Desa/Kelurahan</option>
                                <option value="Antar Desa/Kelurahan"
                                    {{ old('klasifikasi_pindah') == 'Antar Desa/Kelurahan' ? 'selected' : '' }}>Antar
                                    Desa/Kelurahan</option>
                                <option value="Antar Kecamatan"
                                    {{ old('klasifikasi_pindah') == 'Antar Kecamatan' ? 'selected' : '' }}>Antar Kecamatan
                                </option>
                                <option value="Antar Kab/Kota"
                                    {{ old('klasifikasi_pindah') == 'Antar Kab/Kota' ? 'selected' : '' }}>Antar Kab/Kota
                                </option>
                                <option value="Antar Provinsi"
                                    {{ old('klasifikasi_pindah') == 'Antar Provinsi' ? 'selected' : '' }}>Antar Provinsi
                                </option>
                            </select>
                            @error('klasifikasi_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jenis_perpindahan">Jenis Perpindahan</label>
                            <select class="form-control @error('jenis_perpindahan') is-invalid @enderror"
                                id="jenis_perpindahan" name="jenis_perpindahan">
                                <option value="">-- Pilih Jenis Perpindahan --</option>
                                <option value="Kepala Keluarga"
                                    {{ old('jenis_perpindahan') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga
                                </option>
                                <option value="Kep. Keluarga dan Seluruh Anggota Keluarga"
                                    {{ old('jenis_perpindahan') == 'Kep. Keluarga dan Seluruh Anggota Keluarga' ? 'selected' : '' }}>
                                    Kep. Keluarga dan Seluruh Anggota Keluarga</option>
                                <option value="Kep. Keluarga dan Sebagian Anggota Keluarga"
                                    {{ old('jenis_perpindahan') == 'Kep. Keluarga dan Sebagian Anggota Keluarga' ? 'selected' : '' }}>
                                    Kep. Keluarga dan Sebagian Anggota Keluarga</option>
                                <option value="Anggota Keluarga"
                                    {{ old('jenis_perpindahan') == 'Anggota Keluarga' ? 'selected' : '' }}>Anggota Keluarga
                                </option>
                            </select>
                            @error('jenis_perpindahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_no_kk_tidakpindah">Status Nomor KK Tidak Pindah</label>
                            <select class="form-control @error('status_no_kk_tidakpindah') is-invalid @enderror"
                                id="status_no_kk_tidakpindah" name="status_no_kk_tidakpindah">
                                <option value="">-- Pilih Status KK Tidak Pindah --</option>
                                <option value="Numpang KK"
                                    {{ old('status_no_kk_tidakpindah') == 'Numpang KK' ? 'selected' : '' }}>Numpang KK
                                </option>
                                <option value="Membuat KK baru"
                                    {{ old('status_no_kk_tidakpindah') == 'Membuat KK baru' ? 'selected' : '' }}>Membuat KK
                                    baru</option>
                                <option value="Tidak ada anggota keluarga yang ditinggal"
                                    {{ old('status_no_kk_tidakpindah') == 'Tidak ada anggota keluarga yang ditinggal' ? 'selected' : '' }}>
                                    Tidak ada anggota keluarga yang ditinggal</option>
                                <option value="Nomor KK tetap"
                                    {{ old('status_no_kk_tidakpindah') == 'Nomor KK tetap' ? 'selected' : '' }}>Nomor KK
                                    tetap</option>
                            </select>
                            @error('status_no_kk_tidakpindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status_no_kk_pindah">Status Nomor KK Pindah</label>
                            <select class="form-control @error('status_no_kk_pindah') is-invalid @enderror"
                                id="status_no_kk_pindah" name="status_no_kk_pindah">
                                <option value="">-- Pilih Status KK Pindah --</option>
                                <option value="Numpang KK"
                                    {{ old('status_no_kk_pindah') == 'Numpang KK' ? 'selected' : '' }}>Numpang KK</option>
                                <option value="Membuat KK baru"
                                    {{ old('status_no_kk_pindah') == 'Membuat KK baru' ? 'selected' : '' }}>Membuat KK baru
                                </option>
                                <option value="Nama Kep. keluarga dan No. KK tetap"
                                    {{ old('status_no_kk_pindah') == 'Nama Kep. keluarga dan No. KK tetap' ? 'selected' : '' }}>
                                    Nama Kep. keluarga dan No. KK tetap</option>
                            </select>
                            @error('status_no_kk_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="rencana_tgl_pindah">Tanggal Rencana Pindah</label>
                            <input type="date" class="form-control @error('rencana_tgl_pindah') is-invalid @enderror"
                                id="rencana_tgl_pindah" name="rencana_tgl_pindah"
                                value="{{ old('rencana_tgl_pindah') }}">
                            @error('rencana_tgl_pindah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Anggota Keluarga yang Pindah</h5>
                            <div id="anggota-container">
                                <div class="anggota-item">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <input type="text"
                                                class="form-control @error('anggota.0.nik') is-invalid @enderror"
                                                name="anggota[0][nik]" placeholder="NIK"
                                                value="{{ old('anggota.0.nik') }}">
                                            @error('anggota.0.nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text"
                                                class="form-control @error('anggota.0.nama') is-invalid @enderror"
                                                name="anggota[0][nama]" placeholder="Nama"
                                                value="{{ old('anggota.0.nama') }}">
                                            @error('anggota.0.nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text"
                                                class="form-control @error('anggota.0.shdk') is-invalid @enderror"
                                                name="anggota[0][shdk]" placeholder="SHDK"
                                                value="{{ old('anggota.0.shdk') }}">
                                            @error('anggota.0.shdk')
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
                        '][nik]" placeholder="NIK"></div><div class="col-md-3"><input type="text" class="form-control" name="anggota[' +
                        x +
                        '][nama]" placeholder="Nama"></div><div class="col-md-3"><input type="text" class="form-control" name="anggota[' +
                        x +
                        '][shdk]" placeholder="SHDK"></div><div class="col-12 mt-2"><button type="button" class="btn btn-danger btn-sm remove-anggota">Hapus</button></div></div></div>'
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
