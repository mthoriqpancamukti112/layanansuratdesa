@extends('layout.be.template')
@section('title', 'Verifikasi Surat ')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>VERIFIKASI SURAT</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if ($suratPenduduk->status === 'disetujui')
                <div class="alert alert-success">
                    Surat Anda berhasil di acc oleh admin, anda bisa melakukan print pada surat yang anda buat.
                </div>
            @else
                <div class="alert alert-info">
                    Anda belum bisa melakukan print surat, harap tunggu acc dari admin.
                </div>
            @endif
        </div>
    </div>
@endsection
