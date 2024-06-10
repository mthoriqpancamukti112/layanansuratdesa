@extends('layout.be.template')
@section('title', 'Data Desa')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>DATA DESA BELEKA</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <a href="{{ route('desa.create') }}" type="button" class="btn btn-success">Tambah Data</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="table-1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Kades</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($desas as $desa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="/image_desa/{{ $desa->image }}" alt="{{ $desa->nama_desa }}" width="50px"
                                        class="rounded">
                                </td>
                                <td>{{ $desa->alamat_kantor }}</td>
                                <td>{{ $desa->no_telp }}</td>
                                <td>{{ $desa->email }}</td>
                                <td>{{ $desa->kades }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button type="button" class="btn btn-info mr-2" data-toggle="modal"
                                            data-target="#modalLihat{{ $desa->id }}">Detail</button>
                                        <a href="{{ route('desa.edit', $desa->id) }}" class="btn btn-warning mr-2">Edit</a>
                                        <form action="{{ route('desa.destroy', $desa->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus?')">Delete</button>
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
@endsection
@section('konten')
    @foreach ($desas as $desa)
        <!-- Modal -->
        <div class="modal fade" id="modalLihat{{ $desa->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLihatLabel{{ $desa->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLihatLabel{{ $desa->id }}">Detail Desa
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama Desa:</strong> {{ $desa->nama_desa }}</p>
                                <p><strong>Kecamatan:</strong> {{ $desa->kecamatan }}</p>
                                <p><strong>Kabupaten:</strong> {{ $desa->kabupaten }}</p>
                                <p><strong>Provinsi:</strong> {{ $desa->provinsi }}</p>
                                <p><strong>Alamat Kantor:</strong> {{ $desa->alamat_kantor }}</p>
                                <p><strong>No Telp:</strong> {{ $desa->no_telp }}</p>
                                <p><strong>Email:</strong> {{ $desa->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Kades:</strong> {{ $desa->kades }}</p>
                                <p><strong>NIP Kades:</strong> {{ $desa->nip_kades }}</p>
                                <p><strong>Sekdes:</strong> {{ $desa->sekdes }}</p>
                                <p><strong>NIP Sekdes:</strong> {{ $desa->nip_sekdes }}</p>
                                <p><strong>Bendahara:</strong> {{ $desa->bendahara }}</p>
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
