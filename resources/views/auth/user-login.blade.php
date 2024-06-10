<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5 text-center">
                    <img src="/img/beleka.png" height="100%" width="50%" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="POST" action="/user-login">
                        @csrf
                        <div class="d-flex flex-row align-items-center justify-content-center">
                            <p class="lead fw-normal mb-4 me-3" style="font-size: 32px"><b>Login</b></p>
                        </div>
                        <p style="font-size: 12px">Isilah formulir di bawah ini untuk masuk ke layanan surat desa beleka
                        </p>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div data-mdb-input-init class="form-outline">
                            <input type="number" id="nik" name="nik" class="form-control form-control-lg"
                                value="{{ old('nik') }}" placeholder="Masukan nik sesuai ktp" />
                            <label class="form-label" for="nik">NIK</label>
                        </div>
                        @if ($errors->has('nik'))
                            <div class="text-danger small">
                                {{ $errors->first('nik') }}
                            </div>
                        @endif

                        <div data-mdb-input-init class="form-outline mt-3">
                            <input type="text" id="username" name="username" class="form-control form-control-lg"
                                placeholder="Masukan nama lengkap sesuai ktp" />
                            <label class="form-label" for="username">Nama Lengkap</label>
                        </div>
                        @if ($errors->has('username'))
                            <div class="text-danger small">
                                {{ $errors->first('username') }}
                            </div>
                        @endif


                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-block"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Belum punya akun? <a
                                    href="{{ route('register.index') }}" class="link-danger">Daftar</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.umd.min.js"></script>
</body>

</html>
