@extends('layout.be.template')
@section('title', 'Data Penduduk')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>DATA PENDUDUK</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Data Penduduk</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No KK</th>
                                    <th>Nama</th>
                                    <th>Tempat Lahir</th>
                                    <th>Desa</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penduduk as $key => $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->no_kk }}</td>
                                        <td>{{ $p->user->username }}</td>
                                        <td>{{ $p->tempat_lahir }}</td>
                                        <td>{{ $p->desa }}</td>
                                        <td>{{ $p->alamat }}</td>
                                        <td>{{ $p->no_hp }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                                    data-target="#modalLihat{{ $p->id }}">Detail</button>
                                                <form action="{{ route('penduduk.destroy', $p->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('konten')
    @foreach ($penduduk as $key => $p)
        <div class="modal fade" id="modalLihat{{ $p->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLihatLabel{{ $p->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLihatLabel{{ $p->id }}">Detail Penduduk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>No KK:</strong> {{ $p->no_kk }}</p>
                                <p><strong>Nama:</strong> {{ $p->user->username }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $p->jk }}</p>
                                <p><strong>Tempat Lahir:</strong> {{ $p->tempat_lahir }}</p>
                                <p><strong>Tanggal Lahir:</strong>
                                    {{ \Carbon\Carbon::parse($p->tgl_lahir)->format('d/m/Y') }}
                                </p>
                                <p><strong>Agama:</strong> {{ $p->agama }}</p>
                                <p><strong>Status:</strong> {{ $p->status }}</p>
                                <p><strong>Pendidikan:</strong> {{ $p->pendidikan }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Pekerjaan:</strong> {{ $p->pekerjaan }}</p>
                                <p><strong>Provinsi:</strong> {{ $p->provinsi }}</p>
                                <p><strong>Kabupaten:</strong> {{ $p->kabupaten }}</p>
                                <p><strong>Kecamatan:</strong> {{ $p->kecamatan }}</p>
                                <p><strong>Desa:</strong> {{ $p->desa }}</p>
                                <p><strong>Alamat:</strong> {{ $p->alamat }}</p>
                                <p><strong>No HP:</strong> {{ $p->no_hp }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
