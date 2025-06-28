@extends('layout.be.template')
@section('title', 'Data User')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data User</h4>
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($users->isEmpty())
                            <p>Tidak ada user yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->username }}</td>
                                            @if (!empty($user->email))
                                                <td>{{ $user->email }}</td>
                                            @else
                                                <td>Tidak ada email</td>
                                            @endif
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if (auth()->check() && auth()->user()->role == 'admin' && $user->role == 'admin')
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-warning btn-sm mr-2">Edit</a>
                                                    @endif
                                                    <button type="button" class="btn btn-info btn-sm mr-2"
                                                        data-toggle="modal" data-target="#userModal{{ $user->id }}">
                                                        Lihat
                                                    </button>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
                                                        style="display:inline;"
                                                        onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('konten')
    @foreach ($users as $user)
        <!-- Modal -->
        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" role="dialog"
            aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel{{ $user->id }}">
                            Detail User: {{ $user->username }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($user->admin)
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>NIK:</strong> {{ $user->admin->nik }}</p>
                                    <p><strong>No KK:</strong> {{ $user->admin->no_kk }}</p>
                                    <p><strong>Jenis Kelamin:</strong> {{ $user->admin->jk }}</p>
                                    <p><strong>Tempat Lahir:</strong> {{ $user->admin->tempat_lahir }}</p>
                                    <p><strong>Tanggal Lahir:</strong>
                                        {{ \Carbon\Carbon::parse($user->admin->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                    <p><strong>Kewarganegaraan:</strong> {{ $user->admin->kewarganegaraan }}</p>
                                    <p><strong>Agama:</strong> {{ $user->admin->agama }}</p>
                                    <p><strong>Status:</strong> {{ $user->admin->status }}</p>
                                    <p><strong>Pendidikan:</strong> {{ $user->admin->pendidikan }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Pekerjaan:</strong> {{ $user->admin->pekerjaan }}</p>
                                    <p><strong>Provinsi:</strong> {{ $user->admin->provinsi }}</p>
                                    <p><strong>Kabupaten:</strong> {{ $user->admin->kabupaten }}</p>
                                    <p><strong>Kecamatan:</strong> {{ $user->admin->kecamatan }}</p>
                                    <p><strong>Alamat:</strong> {{ $user->admin->alamat }}</p>
                                    <p><strong>No HP:</strong> {{ $user->admin->no_hp }}</p>
                                    <p><strong>Desa:</strong> {{ $user->admin->desa }}</p>
                                    <p><strong>Tanggal
                                            Buat:</strong>
                                        {{ \Carbon\Carbon::parse($user->admin->tgl_buat)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($user->penduduk)
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>NIK:</strong> {{ $user->penduduk->nik }}</p>
                                    <p><strong>No KK:</strong> {{ $user->penduduk->no_kk }}</p>
                                    <p><strong>Jenis Kelamin:</strong> {{ $user->penduduk->jk }}
                                    </p>
                                    <p><strong>Tempat Lahir:</strong> {{ $user->penduduk->tempat_lahir }}</p>
                                    <p><strong>Tanggal Lahir:</strong>
                                        {{ \Carbon\Carbon::parse($user->penduduk->tgl_lahir)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                    </p>
                                    <p><strong>Kewarganegaraan:</strong> {{ $user->penduduk->kewarganegaraan }}</p>
                                    <p><strong>Agama:</strong> {{ $user->penduduk->agama }}</p>
                                    <p><strong>Status:</strong> {{ $user->penduduk->status }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Pendidikan:</strong> {{ $user->penduduk->pendidikan }}</p>
                                    <p><strong>Pekerjaan:</strong> {{ $user->penduduk->pekerjaan }}</p>
                                    <p><strong>Provinsi:</strong> {{ $user->penduduk->provinsi }}</p>
                                    <p><strong>Kabupaten:</strong> {{ $user->penduduk->kabupaten }}</p>
                                    <p><strong>Kecamatan:</strong> {{ $user->penduduk->kecamatan }}</p>
                                    <p><strong>Desa:</strong> {{ $user->penduduk->desa }}</p>
                                    <p><strong>Alamat:</strong> {{ $user->penduduk->alamat }}</p>
                                    <p><strong>No HP:</strong> {{ $user->penduduk->no_hp }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
