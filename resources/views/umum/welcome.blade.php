<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Aplikasi Arsip MOU</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">

    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/genosstyle.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet" />
    <link href="{{ asset('/css/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>


</head>

<body class="bodypolos">

    @if ($message = Session::get('warning'))
    <script>
        Swal.fire({
            type: 'success',
            title: 'Pendaftaran berhasil',
            showConfirmButton: false,
            timer: 1500
        })
    </script>
    @endif

    <nav class="navbar navbarfont navbar-expand-lg navbar-inverse navbar-dark fixed-top home pr-5" style="background-color: rgba(0, 0, 0, 0.0)">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span id="toggler"><i class="fa fa-bars" aria-hidden="true"></i></span>
        </button>
        <a class="navbar-brand" href="#">
            <!-- <img src="{{ asset('/assets/gambar/logo2.png') }} " alt="logo" /> -->
        </a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ml-auto mt-2 mt-sms-0  ">

                <li class="nav-item ">
                    <!-- <a class="nav-link" href="/login"> Login <i class="fa fa-user"></i></a> -->
                </li>

            </ul>
        </div>
    </nav>

    <section class="gambarfullhome" style="background-position: 0,-100px;background-size: 110%">
        <div class="bodywelcome">
            <div class="row">
                <div class="col-md-6">


                    <div class="bgtekshome">

                        <div class="tekshome">
                            <h1 class="judulhome anJudul">
                                SIKHI
                            </h1>

                            <p class="isihome anIsi">
                                Sistem Informasi Kerjasama dan Hubungan International
                            </p>

                            <a class="btn btn-lg anBtn btn-depan" href="{{route('login')}}">Login</a>
                            <a class="btn btn-lg anBtn btn-depan" href="/registermember">Daftar</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="app" style="padding-top: 150px;width: 600px">
                        {!! $chart->container() !!}
                    </div>
                    <script src="https://unpkg.com/vue"></script>
                    <script>
                        var app = new Vue({
                            el: '#app',
                        });
                    </script>
                    <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
                    {!! $chart->script() !!}
                </div>
            </div>
        </div>
    </section>

    <!-- JS -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
</body>
