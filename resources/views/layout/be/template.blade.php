<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title', 'Dashboard')</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/backend/assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/backend/assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/weather-icon/css/weather-icons.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/weather-icon/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="/backend/assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="/backend/assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/backend/assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/backend/assets/modules/prism/prism.css" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="/backend/assets/css/style.css">
    <link rel="stylesheet" href="/backend/assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">

            @include('layout.be.top-nav')

            @include('layout.be.sidebar')

            <div class="main-content">
                <section class="section">
                    @yield('content')

                </section>

                @yield('konten')

            </div>

            @include('layout.be.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="/backend/assets/modules/jquery.min.js"></script>
    <script src="/backend/assets/modules/popper.js"></script>
    <script src="/backend/assets/modules/tooltip.js"></script>
    <script src="/backend/assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/backend/assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/backend/assets/modules/moment.min.js"></script>
    <script src="/backend/assets/js/stisla.js"></script>

    @yield('scripts')

    <!-- JS Libraies -->
    <script src="/backend/assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
    <script src="/backend/assets/modules/chart.min.js"></script>
    <script src="/backend/assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="/backend/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/backend/assets/modules/summernote/summernote-bs4.js"></script>
    <script src="/backend/assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="/backend/assets/modules/datatables/datatables.min.js"></script>
    <script src="/backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="/backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
    <script src="/backend/assets/modules/jquery-ui/jquery-ui.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="/backend/assets/js/page/index-0.js"></script>
    <script src="/backend/assets/js/page/modules-datatables.js"></script>
    <!-- JS Libraies -->
    <script src="/backend/assets/modules/prism/prism.js"></script>

    <!-- Page Specific JS File -->
    <script src="/backend/assets/js/page/bootstrap-modal.js"></script>

    <!-- Template JS File -->
    <script src="/backend/assets/js/scripts.js"></script>
    <script src="/backend/assets/js/custom.js"></script>
</body>

</html>
