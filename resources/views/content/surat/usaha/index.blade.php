@extends('layout.be.template')
@section('title', 'Daftar Surat Usaha')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Usaha</h4>
                    <a href="{{ route('surat.usaha.create') }}" class="btn btn-primary">Buat Surat Usaha Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat usaha yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Bidang Usaha</th>
                                        <th>Nama Usaha</th>
                                        <th>Nama Pemohon</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $suratPenduduk)
                                        @foreach ($suratPenduduk->detailSurats as $detail)
                                            <tr>
                                                <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                                <td>{{ $detail->bidang_usaha }}</td>
                                                <td>{{ $detail->nama_usaha_skusaha }}</td>
                                                <td>{{ $suratPenduduk->user->username }}</td>
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{-- <a href="{{ route('surat.usaha.edit', $suratPenduduk->id) }}"
                                                            class="btn btn-warning btn-sm mr-2">Edit</a> --}}
                                                        <a href="{{ route('surat.usaha.print', $suratPenduduk->id) }}"
                                                            class="btn btn-primary btn-sm mr-2" target="_blank">Print</a>
                                                        <form
                                                            action="{{ route('surat.usaha.destroy', $suratPenduduk->id) }}"
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
