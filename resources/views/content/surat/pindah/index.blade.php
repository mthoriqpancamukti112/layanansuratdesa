@extends('layout.be.template')
@section('title', 'Daftar Surat Pindah')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Pindah</h4>
                    <a href="{{ route('surat.pindah.create') }}" class="btn btn-primary">Buat Surat Pindah Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat pindah yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Nama Pemohon</th>
                                        <th>Alasan Pindah</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Nama Anggota Pindah</th>
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
                                                <td>{{ $detail->alasan_pindah }}</td>
                                                <td>{{ \Carbon\Carbon::parse($suratPenduduk->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($suratPenduduk->anggotaKeluargaPindahs as $anggota)
                                                            <li>{{ $anggota->nama }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('surat.pindah.print', $suratPenduduk->id) }}"
                                                            class="btn btn-primary btn-sm mr-2">Print</a>
                                                        <form
                                                            action="{{ route('surat.pindah.destroy', $suratPenduduk->id) }}"
                                                            method="POST" style="display:inline;"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">
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
