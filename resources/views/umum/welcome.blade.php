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


</head>
<body class="bodypolos">


<nav class="navbar navbarfont navbar-expand-lg navbar-inverse navbar-dark fixed-top home" style="background-color: rgba(0, 0, 0, 0.0)">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span id="toggler"><i class="fa fa-bars" aria-hidden="true"></i></span>
    </button>
    <a class="navbar-brand" href="#">
        <!-- <img src="{{ asset('/assets/gambar/logo2.png') }} " alt="logo" /> -->
    </a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ml-auto mt-2 mt-sms-0  ">

            <li class="nav-item ">
                <a class="nav-link" href="/login"> Login <i class="fa fa-user"></i></a>
            </li>

        </ul>
    </div>
</nav>

<section class="gambarfullhome" style="background-position: 0,-100px;background-size: 110%">

    <div class="bgtekshome">

        <div class="tekshome">
            <h1 class="judulhome anJudul">
                Aplikasi Arsip MOU
            </h1>

            <p class="isihome anIsi">
                Pengarsipan MOU UNIVERSITAS STMIK DUTA BANGSA
            </p>

            <a class="btn btn-lg anBtn btn-depan" href="{{route('login')}}">Mulai</a>
        </div>
    </div>
</section>

<!-- JS -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>
</body>
