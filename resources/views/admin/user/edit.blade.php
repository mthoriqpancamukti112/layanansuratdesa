@extends('layout.be.template')

@section('title', 'Edit Data User')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>EDIT DATA USER</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <form action="{{ route('user.update', $admin->id) }}" method="POST">
            @csrf
            @method('PUT')
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

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $admin->user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Password minimal 6">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror" required>
                                <option value="">--Pilih--</option>
                                <option value="admin" {{ old('role', $admin->user->role) == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username', $admin->user->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                class="form-control @error('tempat_lahir') is-invalid @enderror"
                                value="{{ old('tempat_lahir', $admin->tempat_lahir) }}" required>
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kewarganegaraan</label>
                            <input type="text" name="kewarganegaraan"
                                class="form-control @error('kewarganegaraan') is-invalid @enderror"
                                value="{{ old('kewarganegaraan', $admin->kewarganegaraan) }}" required>
                            @error('kewarganegaraan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Agama</label>
                            <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                <option value="">--Pilih--</option>
                                <option value="Islam" {{ old('agama', $admin->agama) == 'Islam' ? 'selected' : '' }}>Islam
                                </option>
                                <option value="Kristen" {{ old('agama', $admin->agama) == 'Kristen' ? 'selected' : '' }}>
                                    Kristen</option>
                                <option value="Katolik" {{ old('agama', $admin->agama) == 'Katolik' ? 'selected' : '' }}>
                                    Katolik</option>
                                <option value="Hindu" {{ old('agama', $admin->agama) == 'Hindu' ? 'selected' : '' }}>Hindu
                                </option>
                                <option value="Buddha" {{ old('agama', $admin->agama) == 'Buddha' ? 'selected' : '' }}>
                                    Buddha</option>
                                <option value="Konghucu" {{ old('agama', $admin->agama) == 'Konghucu' ? 'selected' : '' }}>
                                    Konghucu</option>
                            </select>
                            @error('agama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="">--Pilih--</option>
                                <option value="Belum Menikah"
                                    {{ old('status', $admin->status) == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah
                                </option>
                                <option value="Menikah" {{ old('status', $admin->status) == 'Menikah' ? 'selected' : '' }}>
                                    Menikah</option>
                                <option value="Cerai Hidup"
                                    {{ old('status', $admin->status) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup
                                </option>
                                <option value="Cerai Mati"
                                    {{ old('status', $admin->status) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati
                                </option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pendidikan</label>
                            <select name="pendidikan" class="form-control @error('pendidikan') is-invalid @enderror"
                                required>
                                <option value="">--Pilih--</option>
                                <option value="SD"
                                    {{ old('pendidikan', $admin->pendidikan) == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP"
                                    {{ old('pendidikan', $admin->pendidikan) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA"
                                    {{ old('pendidikan', $admin->pendidikan) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="Diploma"
                                    {{ old('pendidikan', $admin->pendidikan) == 'Diploma' ? 'selected' : '' }}>Diploma
                                </option>
                                <option value="Sarjana"
                                    {{ old('pendidikan', $admin->pendidikan) == 'Sarjana' ? 'selected' : '' }}>Sarjana
                                </option>
                                <option value="Magister"
                                    {{ old('pendidikan', $admin->pendidikan) == 'Magister' ? 'selected' : '' }}>Magister
                                </option>
                                <option value="Doktor"
                                    {{ old('pendidikan', $admin->pendidikan) == 'Doktor' ? 'selected' : '' }}>Doktor
                                </option>
                            </select>
                            @error('pendidikan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan"
                                class="form-control @error('pekerjaan') is-invalid @enderror"
                                value="{{ old('pekerjaan', $admin->pekerjaan) }}">
                            @error('pekerjaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                                value="{{ old('nik', $admin->nik) }}">
                            @error('nik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No KK</label>
                            <input type="text" name="no_kk" class="form-control @error('no_kk') is-invalid @enderror"
                                value="{{ old('no_kk', $admin->no_kk) }}">
                            @error('no_kk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jk" class="form-control @error('jk') is-invalid @enderror">
                                <option value="">--Pilih--</option>
                                <option value="Laki-laki" {{ old('jk', $admin->jk) == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="Perempuan" {{ old('jk', $admin->jk) == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir"
                                class="form-control @error('tgl_lahir') is-invalid @enderror"
                                value="{{ old('tgl_lahir', $admin->tgl_lahir) }}">
                            @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Provinsi</label>
                            <input type="text" name="provinsi"
                                class="form-control @error('provinsi') is-invalid @enderror"
                                value="{{ old('provinsi', $admin->provinsi) }}" required>
                            @error('provinsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <input type="text" name="kabupaten"
                                class="form-control @error('kabupaten') is-invalid @enderror"
                                value="{{ old('kabupaten', $admin->kabupaten) }}" required>
                            @error('kabupaten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <input type="text" name="kecamatan"
                                class="form-control @error('kecamatan') is-invalid @enderror"
                                value="{{ old('kecamatan', $admin->kecamatan) }}" required>
                            @error('kecamatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $admin->alamat) }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" name="no_hp"
                                class="form-control @error('no_hp') is-invalid @enderror"
                                value="{{ old('no_hp', $admin->no_hp) }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Desa</label>
                            <input type="text" name="desa"
                                class="form-control @error('desa') is-invalid @enderror"
                                value="{{ old('desa', $admin->desa) }}" required>
                            @error('desa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Simpan</button>
            </div>
        </form>
    </div>
@endsection
