<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Surat Desa Beleka</title>
    <link rel="stylesheet" href="/style.css">
    <!-- Fontawesome Link for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div style="display: flex">
                <h2 class="logo"><a href="{{ route('home.index') }}"><img src="/img/beleka.png"
                            style="height: 70px; width: 100%" alt=""></a></h2>
            </div>

            <input type="checkbox" id="menu-toggler">
            <label for="menu-toggler" id="hamburger-btn">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="32px"
                    height="24px">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 18h18v-2H3v2zm0-5h18V11H3v2zm0-7v2h18V6H3z" />
                </svg>
            </label>
            <ul class="all-links">
                <li><a href="{{ route('home.index') }}">Home</a></li>
                <li><a href="#services">Sejarah</a></li>
                <li><a href="#portfolio">Visi Misi</a></li>
                <li><a href="{{ route('login.index') }}">Login Staff</a></li>
            </ul>
        </nav>
    </header>

    <section class="homepage" id="home">
        <div class="content">
            <div class="text">
                <h1>LAYANAN SURAT DESA BELEKA</h1>
                <p>Silahkan pilih layanan surat dibawah ini.</p>
            </div>
            <div style="display: flex; align-items: center; justify-content: center">
                <a href="{{ route('user.login.index') }}">Buat dan Cetak Surat Sendiri</a>
                <a href="{{ route('permohonansurat.create') }}">Kirim Permohonan Surat</a>
            </div>
        </div>
    </section>
</body>

</html>
