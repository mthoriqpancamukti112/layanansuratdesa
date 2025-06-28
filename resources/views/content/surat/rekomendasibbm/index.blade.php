@extends('layout.be.template')
@section('title', 'Daftar Surat Rekomendasi BBM')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Rekomendasi BBM</h4>
                    <a href="{{ route('surat.rekomendasibbm.create') }}" class="btn btn-primary">Buat Surat Rekomendasi BBM
                        Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat rekomendasi BBM yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Nama Pemohon</th>
                                        <th>Nama Usaha</th>
                                        <th>Jenis Usaha</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $suratPenduduk)
                                        @foreach ($suratPenduduk->detailSurats as $detail)
                                            <tr>
                                                <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                                <td>{{ $suratPenduduk->user->username }}</td>
                                                <td>{{ $detail->nama_usaha_rekomendasibbm }}</td>
                                                <td>{{ $detail->jenis_usaha }}</td>
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('surat.rekomendasibbm.print', $suratPenduduk->id) }}"
                                                            class="btn btn-primary btn-sm mr-2" target="_blank">Print</a>
                                                        <form
                                                            action="{{ route('surat.rekomendasibbm.destroy', $suratPenduduk->id) }}"
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
