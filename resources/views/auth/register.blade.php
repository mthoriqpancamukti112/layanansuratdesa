<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Penduduk</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/backend/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/fontawesome/css/all.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/backend/assets/css/style.css">
    <link rel="stylesheet" href="/backend/assets/css/components.css">
</head>

<body>
    <div class="container mt-5 mb-5">
        <div class="text-center mb-4">
            <h1>Halaman Registrasi</h1>
            <p>Silahkan isi form berikut untuk mendaftar ke website layanan surat desa beleka.</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-center">
                        <div class="flex-fill p-2">
                            <div class="form-group">
                                <div class="section-title">NIK</div>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                    id="nik" name="nik" value="{{ old('nik') }}"
                                    placeholder="NIK sesuai KTP" required maxlength="20">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Nama Lengkap</div>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}"
                                    placeholder="ex: John Senha" required maxlength="100">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">No KK</div>
                                <input type="text" class="form-control @error('no_kk') is-invalid @enderror"
                                    id="no_kk" name="no_kk" value="{{ old('no_kk') }}" placeholder="Nomor KK"
                                    required maxlength="20">
                                @error('no_kk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Jenis Kelamin</div>
                                <select class="form-control @error('jk') is-invalid @enderror" id="jk"
                                    name="jk" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki" {{ old('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                    </option>
                                    <option value="Perempuan" {{ old('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                    </option>
                                </select>
                                @error('jk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="section-title">Tempat Lahir</div>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                                    placeholder="Tempat Lahir" required maxlength="100">
                                @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Tanggal Lahir</div>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                                @error('tgl_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-fill p-2">
                            <div class="form-group">
                                <div class="section-title">Kewarganegaraan</div>
                                <input type="text"
                                    class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                    id="kewarganegaraan" name="kewarganegaraan" value="{{ old('kewarganegaraan') }}"
                                    placeholder="ex: Indonesia" required maxlength="50">
                                @error('kewarganegaraan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Agama</div>
                                <select class="form-control @error('agama') is-invalid @enderror" id="agama"
                                    name="agama" required>
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                    </option>
                                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen
                                    </option>
                                    <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik
                                    </option>
                                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                    </option>
                                    <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha
                                    </option>
                                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                        Konghucu</option>
                                </select>
                                @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Status</div>
                                <select class="form-control @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Menikah" {{ old('status') == 'Menikah' ? 'selected' : '' }}>Menikah
                                    </option>
                                    <option value="Belum Menikah"
                                        {{ old('status') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                    <option value="Janda" {{ old('status') == 'Janda' ? 'selected' : '' }}>Janda
                                    </option>
                                    <option value="Duda" {{ old('status') == 'Duda' ? 'selected' : '' }}>Duda
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Pendidikan Terakhir</div>
                                <select class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan"
                                    name="pendidikan" required>
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD" {{ old('pendidikan') == 'SD' ? 'selected' : '' }}>SD
                                    </option>
                                    <option value="SMP" {{ old('pendidikan') == 'SMP' ? 'selected' : '' }}>SMP
                                    </option>
                                    <option value="SMA" {{ old('pendidikan') == 'SMA' ? 'selected' : '' }}>SMA
                                    </option>
                                    <option value="D1" {{ old('pendidikan') == 'D1' ? 'selected' : '' }}>D1
                                    </option>
                                    <option value="D2" {{ old('pendidikan') == 'D2' ? 'selected' : '' }}>D2
                                    </option>
                                    <option value="D3" {{ old('pendidikan') == 'D3' ? 'selected' : '' }}>D3
                                    </option>
                                    <option value="S1" {{ old('pendidikan') == 'S1' ? 'selected' : '' }}>S1
                                    </option>
                                    <option value="S2" {{ old('pendidikan') == 'S2' ? 'selected' : '' }}>S2
                                    </option>
                                    <option value="S3" {{ old('pendidikan') == 'S3' ? 'selected' : '' }}>S3
                                    </option>
                                </select>
                                @error('pendidikan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Pekerjaan</div>
                                <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror"
                                    id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan') }}"
                                    placeholder="Pekerjaan" maxlength="100">
                                @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="section-title">No HP/WA Aktif</div>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                    placeholder="ex: 081xx" required maxlength="15">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-fill p-2">
                            <div class="form-group">
                                <div class="section-title">Provinsi</div>
                                <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                    id="provinsi" name="provinsi" value="{{ old('provinsi') }}"
                                    placeholder="ex: Nusa Tenggara Barat" required maxlength="100">
                                @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Kabupaten</div>
                                <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                    id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}"
                                    placeholder="ex: Lombok Barat" required maxlength="100">
                                @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Kecamatan</div>
                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                    id="kecamatan" name="kecamatan" value="{{ old('kecamatan') }}"
                                    placeholder="ex: Gerung" required maxlength="100">
                                @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="section-title">Desa</div>
                                <input type="text" class="form-control @error('desa') is-invalid @enderror"
                                    id="desa" name="desa" value="{{ old('desa') }}"
                                    placeholder="ex: Beleke" required maxlength="100">
                                @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="section-title">Alamat</div>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="4"
                                    placeholder="ex: Jl. Garuda" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary mx-2">Register</button>
                        <a href="{{ route('home.index') }}" class="btn btn-danger mx-2">Batal</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- General JS Scripts -->
    <script src="/backend/assets/modules/popper.js"></script>
    <script src="/backend/assets/modules/tooltip.js"></script>
    <script src="/backend/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/backend/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/backend/assets/modules/moment.min.js"></script>
    <script src="/backend/assets/modules/jquery.min.js"></script>
    <script src="/backend/assets/js/stisla.js"></script>

    @yield('scripts')

    <!-- Template JS File -->
    <script src="/backend/assets/js/scripts.js"></script>
    <script src="/backend/assets/js/custom.js"></script>
</body>

</html>
