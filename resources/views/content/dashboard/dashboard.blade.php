@extends('layout.be.template')
@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>Welcome Back, {{ Auth::check() ? Auth::user()->username : 'Guest' }}!
                    </h2>
                    {{-- <p class="lead">This page is a place to manage posts, categories and more.</p> --}}
                </div>
            </div>
        </div>
    </div>

    @if (auth()->check() && auth()->user()->role == 'admin')
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('penduduk.index') }}" class="text-decoration-none">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Penduduk</h4>
                            </div>
                            <div class="card-body">
                                {{ $hitung_penduduk }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="" class="text-decoration-none">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ $hitung_user }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('arsip.surat') }}" class="text-decoration-none">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Arsip</h4>
                            </div>
                            <div class="card-body">
                                {{ $hitung_total_buat_surat }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('surat.penduduk.index') }}" class="text-decoration-none">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Permohonan surat untuk di acc</h4>
                            </div>
                            <div class="card-body">
                                {{ $hitung_surat_diproses }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <a href="{{ route('daftarbuatpermohonan.index') }}" class="text-decoration-none">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Penduduk yang ingin dibuatkan surat</h4>
                            </div>
                            <div class="card-body">
                                {{ $hitung_permohonan }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <h4>Jumlah Surat yang Diarsipkan</h4>
                    <div class="row">
                        @foreach ($surat_arsip_counts as $surat_id => $total)
                            @php
                                $surat = \App\Models\Surat::find($surat_id);
                            @endphp
                            <div class="col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $surat ? $surat->nama_surat : 'Unknown' }}</h5>
                                        <p class="card-text">Jumlah Arsip: {{ $total }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
