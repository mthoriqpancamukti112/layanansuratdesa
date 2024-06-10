@extends('layout.be.template')

@section('title', 'Daftar Pembuatan Permohonan Surat')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar yang ingin dibuatkan Surat Permohonan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($permohonanSurats->isEmpty())
                            <p>Daftar pembuatan surat permohonan belum ada.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIK Penduduk</th>
                                        <th>Nama Pemohon</th>
                                        <th>Jenis</th>
                                        <th>No HP</th>
                                        <th>KTP</th>
                                        <th>KK</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permohonanSurats as $permohonanSurat)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $permohonanSurat->nik }}</td>
                                            <td>{{ $permohonanSurat->nama }}</td>
                                            <td>{{ $permohonanSurat->jenis_surat }}</td>
                                            <td>{{ $permohonanSurat->no_hp }}</td>
                                            <td><a href="{{ asset('foto/' . $permohonanSurat->foto) }}" target="_blank">Lihat
                                                    Foto</a></td>
                                            <td><a href="{{ asset('berkas_permohonan_surat/' . $permohonanSurat->upload) }}"
                                                    target="_blank">Download</a></td>
                                            <td> {{ \Carbon\Carbon::parse($permohonanSurat->tgl_buat)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                            </td>
                                            <td>{{ ucfirst($permohonanSurat->status) }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    @if ($permohonanSurat->status == 'diproses')
                                                        <form
                                                            action="{{ route('daftarbuatpermohonan.acc', $permohonanSurat->id) }}"
                                                            method="POST" style="display:inline-block;">
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-success btn-sm mr-2">Acc</button>
                                                        </form>
                                                    @endif
                                                    <form
                                                        action="{{ route('daftarbuatpermohonan.destroy', $permohonanSurat->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus permohonan ini?')">Hapus</button>
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
