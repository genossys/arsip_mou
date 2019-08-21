<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laporan Arsip</title>
    <!-- Fonts -->

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
</head>

<body>

    <style>
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 0cm;
        }
    </style>

    <img src="assets/gambar/kopsurat.png" style="width:100%" alt="">
    <br>
    <div style="width:100%">
        <h4 class="text-center">Laporan Data Arsip</h4>
    </div>
    <br>
    <br>

    <table class="table table-striped">
        <tr>
            <th> #</th>
            <th>Jenis Arsip</th>
            <th>Nomor Arsip</th>
            <th>Mitra</th>
            <th>Tanggal</th>
        </tr>
        @php $i=1; @endphp
        @foreach($arsip as $m)
        <tr>
            <td> {{$i++}}</td>
            <td>{{$m->jenisArsip}}</td>
            <td>{{$m->nomorArsip}}</td>
            <td>{{$m->mitra}}</td>
            <td>{{$m->tanggal}}</td>
        </tr>
        @endforeach
    </table>
    <div style="right:10px;width: 300px;display: inline-block;margin-top:70px">
        <p class="text-center mb-5">Pimpinan</p>
        <p class="text-center">( Dr. Rina Arum Prastyanti SH.,MH )</p>
    </div>

    <div style="left:10px;width: 300px; margin-left : 100px;display: inline-block">
        <p class="text-center mb-5">Admin</p>
        <p class="text-center">( {{auth()->user()->username}} )</p>
    </div>


    <footer class="footer">
        @php $date = new DateTime("now", new DateTimeZone('Asia/Bangkok') ); @endphp
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> di cetak oleh : {{auth()->user()->username}}</p>
        <p class="text-right small mb-0 mt-0 pt-0 pb-0"> tgl: {{ $date->format('d F Y, H:i:s') }} </p>
    </footer>

    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
