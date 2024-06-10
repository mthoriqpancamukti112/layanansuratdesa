@extends('layout.be.template')

@section('title', 'Daftar Surat Permohonan')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Permohonan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Daftar surat permohonan belum ada.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Surat</th>
                                        <th>Nama Pemohon</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal Buat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $index => $suratPenduduk)
                                        @foreach ($suratPenduduk->detailSurats as $detail)
                                            <tr>
                                                <td>{{ $loop->parent->iteration }}</td>
                                                <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                                <td>{{ $suratPenduduk->user ? $suratPenduduk->user->username : 'Nama Tidak Tersedia' }}
                                                </td>
                                                <td>{{ $suratPenduduk->surat->jenis_surat }}</td>
                                                <td>{{ $suratPenduduk->created_at->format('d M Y') }}</td>
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if ($suratPenduduk->status === 'diproses')
                                                            <form
                                                                action="{{ route('surat.penduduk.acc', $suratPenduduk->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-success btn-sm mr-2">Acc</button>
                                                            </form>
                                                        @endif
                                                        <form
                                                            action="{{ route('surat.penduduk.destroy', $suratPenduduk->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
