<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permohonan Surat Desa Beleka</title>

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
            <h1>LAYANAN SURAT BELEKA</h1>
            <p>Silahkan isi form berikut untuk mengajukan permohonan surat.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('permohonansurat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-center">
                        <div class="flex-fill pr-2">
                            <div class="form-group">
                                <label for="nik">Masukan NIK</label>
                                <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                    id="nik" name="nik" value="{{ old('nik') }}"
                                    placeholder="Nik sesuai ktp" required maxlength="20">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nama">Masukan Nama Lengkap</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}"
                                    placeholder="Nama lengkap sesuai ktp" required maxlength="255">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <select class="form-control @error('jenis_surat') is-invalid @enderror" id="jenis_surat"
                                    name="jenis_surat" required>
                                    <option value="">Pilih Jenis Surat</option>
                                    <option value="Surat Keterangan Usaha"
                                        {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>Surat
                                        Keterangan
                                        Usaha
                                    </option>
                                    <option value="Surat Keterangan Kepemilikan Tanah"
                                        {{ old('jenis_surat') == 'Surat Keterangan Kepemilikan Tanah' ? 'selected' : '' }}>
                                        Surat
                                        Keterangan Kepemilikan Tanah
                                    </option>
                                    <option value="Surat Keterangan Tidak Mampu"
                                        {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>
                                        Surat
                                        Keterangan Tidak Mampu
                                    </option>
                                    <option value="Surat Keterangan Pindah"
                                        {{ old('jenis_surat') == 'Surat Keterangan Pindah' ? 'selected' : '' }}>Surat
                                        Keterangan
                                        Pindah
                                    </option>
                                    <option value="Surat Keterangan Ahli Waris"
                                        {{ old('jenis_surat') == 'Surat Keterangan Ahli Waris' ? 'selected' : '' }}>
                                        Surat
                                        Keterangan Ahli Waris
                                    </option>
                                    <option value="Surat Rekomendasi BBM"
                                        {{ old('jenis_surat') == 'Surat Rekomendasi BBM' ? 'selected' : '' }}>Surat
                                        Rekomendasi
                                        BBM
                                    </option>
                                </select>
                                @error('jenis_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="flex-fill pl-2">
                            <div class="form-group">
                                <label for="no_hp">Masukan No HP/WA Aktif</label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required maxlength="15">
                                @error('no_hp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="foto">Upload Foto KTP</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <span style="font-size: 12px">Max: 2 mb</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="upload">Scan KK (PDF)</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" id="upload" name="upload"
                                        accept="application/pdf" required>
                                    @error('upload')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <span style="font-size: 12px">Max: 2 mb</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary mx-2">Submit</button>
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
