@extends('layout.be.template')
@section('title', 'Daftar Surat Tidak Mampu')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Tidak Mampu</h4>
                    <a href="{{ route('surat.tidakmampu.create') }}" class="btn btn-primary">Buat Surat Tidak Mampu Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat tidak mampu yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Keperluan Tidak Mampu</th>
                                        <th>Nama Pemohon</th>
                                        @if (auth()->user()->role == 'admin')
                                            <th>Berkas KK</th>
                                            <th>Berkas KTP</th>
                                        @endif
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $suratPenduduk)
                                        @foreach ($suratPenduduk->detailSurats as $detail)
                                            <tr>
                                                <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                                <td>{{ $detail->keperluan_tidakmampu }}</td>
                                                <td>{{ $suratPenduduk->user->username }}</td>
                                                @if (auth()->user()->role == 'admin')
                                                    <td>
                                                        @if ($suratPenduduk->detailSurats->first()->upload_kk)
                                                            <a href="{{ asset('berkas_sk_tidakmampu/' . $suratPenduduk->detailSurats->first()->upload_kk) }}"
                                                                target="_blank">Lihat KK</a>
                                                        @else
                                                            Tidak Ada Berkas
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($suratPenduduk->detailSurats->first()->upload_ktp)
                                                            <a href="{{ asset('berkas_sk_tidakmampu/' . $suratPenduduk->detailSurats->first()->upload_ktp) }}"
                                                                target="_blank">Lihat KTP</a>
                                                        @else
                                                            Tidak Ada Berkas
                                                        @endif
                                                    </td>
                                                @endif
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <a href="{{ route('surat.tidakmampu.print', $suratPenduduk->id) }}"
                                                            class="btn btn-primary btn-sm mr-2"
                                                            data-status="{{ $suratPenduduk->status }}">Print</a>
                                                        <form
                                                            action="{{ route('surat.tidakmampu.destroy', $suratPenduduk->id) }}"
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
