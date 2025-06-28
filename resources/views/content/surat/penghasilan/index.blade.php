@extends('layout.be.template')
@section('title', 'Daftar Surat Penghasilan Orang Tua')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Penghasilan Orang Tua</h4>
                    <a href="{{ route('surat.penghasilan.create') }}" class="btn btn-primary">Buat Surat Penghasilan Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat penghasilan yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Jenis Surat</th>
                                        <th>Penghasilan</th>
                                        <th>Keperluan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $suratPenduduk)
                                        @foreach ($suratPenduduk->detailSurats as $detail)
                                            <tr>
                                                <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                                <td>{{ $suratPenduduk->surat->jenis_surat }}</td>
                                                <td>{{ 'Rp ' . number_format($detail->jumlah_penghasilan, 0, ',', '.') }}
                                                </td>
                                                <td>{{ $detail->keperluan }}</td>
                                                <td>{{ $suratPenduduk->status }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        {{-- <a href="{{ route('surat.penghasilan.edit', $suratPenduduk->id) }}"
                                                            class="btn btn-warning btn-sm mr-2">Edit</a> --}}
                                                        <a href="{{ route('surat.penghasilan.print', $suratPenduduk->id) }}"
                                                            class="btn btn-primary btn-sm mr-2" target="_blank">Print</a>
                                                        <form
                                                            action="{{ route('surat.penghasilan.destroy', $suratPenduduk->id) }}"
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
