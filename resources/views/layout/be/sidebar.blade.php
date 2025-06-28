<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('dashboard.index') }}">Desa Beleka</a>
        </div>
        {{-- <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Stasasas</a>
        </div> --}}
        <ul class="sidebar-menu">
            <li><a class="nav-link" href="{{ route('dashboard.index') }}"><i class="far fa fa-home"></i>
                    <span>Dashboard</span></a></li>
            @if (auth()->check() && auth()->user()->role == 'admin')
                <li><a class="nav-link" href="{{ route('desa.index') }}"><i class="fas fa-building"></i>
                        <span>Data Desa</span></a></li>

                <li><a class="nav-link" href="{{ route('penduduk.index') }}"><i class="fas fa-users"></i>
                        <span>Data Penduduk</span></a></li>
                <li><a class="nav-link" href="{{ route('surat.create') }}"><i class="fas fa-file"></i>

                        <span>Data Jenis Surat</span></a></li>
            @endif

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa fa-envelope-open-text"></i>
                    <span>Jenis Surat</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('surat.usaha.index') }}">Suket Usaha</a></li>
                    <li><a class="nav-link" href="{{ route('surat.tidakmampu.index') }}">Suket Tidak Mampu</a></li>
                    <li><a class="nav-link" href="{{ route('surat.pindah.index') }}">Suket Pindah</a></li>
                    <li><a class="nav-link" href="{{ route('surat.ahliwaris.index') }}">Suket Ahli Waris</a> </li>
                    <li><a class="nav-link" href="{{ route('surat.tanah.index') }}">Suket Kepemilikan Tanah</a></li>
                    <li><a class="nav-link" href="{{ route('surat.penghasilan.index') }}">Suket Penghasilan Ortu</a>
                    </li>
                    <li><a class="nav-link" href="{{ route('surat.rekomendasibbm.index') }}">Surat Rekomendasi BBM</a>
                    </li>
                </ul>
            </li>

            @if (auth()->check() && auth()->user()->role == 'admin')
                <li><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user"></i>
                        <span>User</span></a></li>
            @endif
        </ul>
    </aside>
</div>
