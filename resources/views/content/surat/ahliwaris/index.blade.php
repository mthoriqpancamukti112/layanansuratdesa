@extends('layout.be.template')
@section('title', 'Daftar Surat Ahli Waris')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Daftar Surat Ahli Waris</h4>
                    <a href="{{ route('surat.ahliwaris.create') }}" class="btn btn-primary">Buat Surat Ahli Waris Baru</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if ($suratPenduduks->isEmpty())
                            <p>Tidak ada surat ahli waris yang ditemukan.</p>
                        @else
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No Surat</th>
                                        <th>Nama Pemohon</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Nama Ahli Waris</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suratPenduduks as $suratPenduduk)
                                        <tr>
                                            <td>{{ $suratPenduduk->surat->no_surat }}</td>
                                            <td>{{ $suratPenduduk->user->username }}</td>
                                            <td> {{ \Carbon\Carbon::parse($suratPenduduk->created_at)->locale('id_ID')->isoFormat('D MMMM YYYY') }}
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($suratPenduduk->anggotaAhliwaris as $anggota)
                                                        <li>{{ $anggota->nama }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $suratPenduduk->status }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{-- <a href="{{ route('surat.ahliwaris.edit', $suratPenduduk->id) }}"
                                                    class="btn btn-warning btn-sm mr-2">Edit</a> --}}
                                                    <a href="{{ route('surat.ahliwaris.print', $suratPenduduk->id) }}"
                                                        class="btn btn-primary btn-sm mr-2">Print</a>
                                                    <form
                                                        action="{{ route('surat.ahliwaris.destroy', $suratPenduduk->id) }}"
                                                        method="POST" style="display:inline;"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
