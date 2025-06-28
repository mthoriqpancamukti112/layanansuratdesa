@extends('layout.be.template')
@section('title', 'Daftar Surat Kepemilikan Tanah')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Kepemilikan Tanah</h4>
                    <a href="{{ route('surat.tanah.create') }}" class="btn btn-primary">Buat Surat Tanah Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat kepemilikan tanah yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Dusun</th>
                                        <th>Nama Desa</th>
                                        <th>Kecamatan</th>
                                        <th>Kabupaten</th>
                                        <th>Status Tanah</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $suratPenduduk)
                                        @foreach ($suratPenduduk->detailSurats as $detail)
                                            <tr>
                                                <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                                <td>{{ $detail->dusun }}</td>
                                                <td>{{ $detail->nama_desa_sktanah }}</td>
                                                <td>{{ $detail->kecamatan_sktanah }}</td>
                                                <td>{{ $detail->kabupaten_sktanah }}</td>
                                                <td>{{ $detail->status_tanah }}</td>
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{-- <a href="{{ route('surat.tanah.edit', $suratPenduduk->id) }}"
                                                            class="btn btn-warning btn-sm mr-2">Edit</a> --}}
                                                        <a href="{{ route('surat.tanah.print', $suratPenduduk->id) }}"
                                                            class="btn btn-primary btn-sm mr-2"
                                                            data-status="{{ $suratPenduduk->status }}"
                                                            target="_blank">Print</a>
                                                        <form
                                                            action="{{ route('surat.tanah.destroy', $suratPenduduk->id) }}"
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
