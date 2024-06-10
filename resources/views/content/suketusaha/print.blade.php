@extends('layout.be.template')
@section('title', 'Print Surat Usaha')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Print Surat Usaha</h4>
                </div>
                <div class="card-body">
                    <h5>Nomor Surat: {{ $surat->no_surat }}</h5>
                    <h5>Nama Usaha: {{ $surat->nama_usaha }}</h5>
                    <h5>Bidang Usaha: {{ $surat->bidang_usaha }}</h5>
                    <h5>Usaha Berjalan Sejak: {{ $surat->berjalan_sejak->format('d-m-Y') }}</h5>
                    <h5>Alamat Usaha: {{ $surat->alamat_usaha }}</h5>
                    <!-- Add any other details you want to include in the print -->
                </div>
            </div>
        </div>
    </div>
@endsection
