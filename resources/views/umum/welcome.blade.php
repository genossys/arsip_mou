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

    <nav class="navbar navbarfont navbar-expand-sm bg-light fixed-top home pr-5">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span id="toggler"><i class="fa fa-bars" aria-hidden="true"></i></span>
        </button>
        <a class="navbar-brand" href="#">
            <img style="width: 100px" src="{{ asset('/assets/gambar/logoudb2.png') }} " alt="logo" />
        </a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ml-auto mt-2 mt-sms-0  ">

                <li class="nav-item ">
                    <a class="nav-link" href="/login"> Login <i class="fa fa-user"></i></a>
                </li>

            </ul>
        </div>
    </nav>

    <section class="" style="background-position: 0,-100px;background-size: 110%">
        <div class="bodywelcome">
            <div class="row pl-3" style="padding-top: 100px">
                <div class="col-md-6">


                    <!-- <div class="bgtekshome">

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
                    </div> -->

                    <h4>Sekilas Tentang UDB:</h4>
                    <p class="text-justify">Universitas Duta Bangsa merupakan salah satu institusi Perguruan Tinggi di Indonesia, tepatnya di Jl Bhayangkara No 55-57 Tipes, Serengan, Surakarta. Universitas Duta Bangsa memiliki 4 Fakultas dan 16 Program Studi. Universitas Duta Bangsa melakukan kerjasama dengan lebih dari 100 institusi/perusahaan/ organisasi dalam negeri dan melakukan kerjasama dengan 15 Institusi Luar Negeri kurang lebih 8 negara. kerjasama dengan luar negeri antara lain yaitu dengan Huachiew Chalermparkiet University, Cheng Shiu University, Universiti Kuala Lumpur, Universiti Sains Malaysia, Glasgow Universiti, Cambodia Universiti, Ramon Llull Universiti, dll.
                        Implementasi kerjasama yang sudah dilakukan dengan Universitas Duta Bangsa dengan beberapa institusinya Luar Negeri yaitu, Student Exchange, Joint Research, Call Of Paper, Focus Group Discussion, Summer Camp, Internship Student, Visiting Lecturer, dll.

                        Mari bergabung dengan kami, Universitas Duta Bangsa.</p>

                    <h4>Langkah - Langkah Kerjasama :</h4>
                    <p class="text-justify">1. Klik menu '<a href="{{route('login')}}">Login</a>' (apabila sudah mempunyai akun)</p>
                    <p>2. Klik menu '<a href="/registermember">Daftar</a>' (apabila belum mempunyai akun)</p>
                    <p>3. Upload Surat Permohonan Kerjasama</p>
                    <p>4. Apabila surat kerjasama sudah di acc, Upload MoU, Berikut template draft MoU (<a href="{{asset('assets/files/DRAFT MOU.doc')}}">link</a>)</p>
                    <p>5. Apabila MoU sudah di acc, Upload MoA, Berikut template draft MoA (<a href="{{asset('assets/files/DRAFT MOA.docx')}}">link</a>)</p></p>
                </div>
                <div class="col-md-6">
                    <div id="app" style="padding-top: 50px;margin-left: 100px;width: 400px">
                        {!! $chart->container() !!}
                    </div>
                    <script src="{{ asset('/js/vue.js') }}"></script>
                    <script>
                        var app = new Vue({
                            el: '#app',
                        });
                    </script>
                    <script src="{{ asset('/js/echarts-en.min.js') }}" charset=utf-8></script>
                    {!! $chart->script() !!}
                </div>
            </div>
        </div>
    </section>

    <!-- JS -->

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/tampilan/genosstyle.js') }}"></script>
    <script src="{{ asset('/js/Chart.min.js') }}" charset="utf-8"></script>
</body>
