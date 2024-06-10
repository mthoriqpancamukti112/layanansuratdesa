@extends('layout.be.template')
@section('title', 'Edit Surat Ahli Waris')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Surat Ahli Waris</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('surat.ahliwaris.update', $suratPenduduk->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="keperluan_ahliwaris">Keperluan Ahli Waris:</label>
                            <textarea id="keperluan_ahliwaris" name="keperluan_ahliwaris"
                                class="form-control @error('keperluan_ahliwaris') is-invalid @enderror" rows="4">{{ $detailSurat->keperluan_ahliwaris }}</textarea>
                            @error('keperluan_ahliwaris')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h5>Anggota Ahli Waris</h5>
                        <div id="anggota-container">
                            @foreach ($anggotaAhliwaris as $index => $anggota)
                                <div class="anggota-item mb-3">
                                    <div class="form-group">
                                        <label for="anggota[{{ $index }}][nama]">Nama:</label>
                                        <input type="text" name="anggota[{{ $index }}][nama]"
                                            class="form-control @error('anggota.' . $index . '.nama') is-invalid @enderror"
                                            value="{{ old('anggota.' . $index . '.nama', $anggota->nama) }}">
                                        @error('anggota.' . $index . '.nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="anggota[{{ $index }}][nik]">NIK:</label>
                                        <input type="text" name="anggota[{{ $index }}][nik]"
                                            class="form-control @error('anggota.' . $index . '.nik') is-invalid @enderror"
                                            value="{{ old('anggota.' . $index . '.nik', $anggota->nik) }}">
                                        @error('anggota.' . $index . '.nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="anggota[{{ $index }}][tempat_lahir]">Tempat Lahir:</label>
                                        <input type="text" name="anggota[{{ $index }}][tempat_lahir]"
                                            class="form-control @error('anggota.' . $index . '.tempat_lahir') is-invalid @enderror"
                                            value="{{ old('anggota.' . $index . '.tempat_lahir', $anggota->tempat_lahir) }}">
                                        @error('anggota.' . $index . '.tempat_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="anggota[{{ $index }}][tgl_lahir]">Tanggal Lahir:</label>
                                        <input type="date" name="anggota[{{ $index }}][tgl_lahir]"
                                            class="form-control @error('anggota.' . $index . '.tgl_lahir') is-invalid @enderror"
                                            value="{{ old('anggota.' . $index . '.tgl_lahir', $anggota->tgl_lahir) }}">
                                        @error('anggota.' . $index . '.tgl_lahir')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="anggota[{{ $index }}][jk]">Jenis Kelamin:</label>
                                        <select name="anggota[{{ $index }}][jk]"
                                            class="form-control @error('anggota.' . $index . '.jk') is-invalid @enderror">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki"
                                                {{ old('anggota.' . $index . '.jk', $anggota->jk) == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan"
                                                {{ old('anggota.' . $index . '.jk', $anggota->jk) == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('anggota.' . $index . '.jk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-anggota" class="btn btn-secondary">Tambah Anggota</button>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let anggotaCount = {{ count($anggotaAhliwaris) }};
            document.getElementById('add-anggota').addEventListener('click', function() {
                const container = document.getElementById('anggota-container');
                const newAnggotaItem = document.createElement('div');
                newAnggotaItem.classList.add('anggota-item', 'mb-3');
                newAnggotaItem.innerHTML = `
                    <div class="form-group">
                        <label for="anggota[${anggotaCount}][nama]">Nama:</label>
                        <input type="text" name="anggota[${anggotaCount}][nama]" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="anggota[${anggotaCount}][nik]">NIK:</label>
                        <input type="text" name="anggota[${anggotaCount}][nik]" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="anggota[${anggotaCount}][tempat_lahir]">Tempat Lahir:</label>
                        <input type="text" name="anggota[${anggotaCount}][tempat_lahir]" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="anggota[${anggotaCount}][tgl_lahir]">Tanggal Lahir:</label>
                        <input type="date" name="anggota[${anggotaCount}][tgl_lahir]" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="anggota[${anggotaCount}][jk]">Jenis Kelamin:</label>
                        <select name="anggota[${anggotaCount}][jk]" class="form-control">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                `;
                container.appendChild(newAnggotaItem);
                anggotaCount++;
            });
        </script>
    @endpush
@endsection
