<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>UDB</title>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset ('adminlte/plugins/font-awesome/css/font-awesome.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/adminlte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css')}}">
    <!-- Genosstyle -->
    <link rel="stylesheet" href="{{ asset('/css/genosstyle.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href=" {{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <link href="{{ asset('/css/sweetalert2.min.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js') }}"></script>


    @yield('css')
</head>

<body class="hold-transition sidebar-mini bodypolos">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a class="nav-link">@yield('judul')</a>
                </li>

            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto" style="margin-right: 0">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="{{route('logout')}}" class="dropdown-item dropdown-footer">Logout</a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-primary" >
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <!-- <img src="{{asset ('/adminlte/img/logoiks.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
                <span class="brand-text font-weight-light">Universitas Duta Bangsa</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <!-- <img src="{{asset ('/adminlte/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image"> -->
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->username}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-database"></i>
                                <p>
                                    Data
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{route ('dataMitra')}}" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Permohonan Kerjasama</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route ('MouMitra')}}" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Mou</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{route ('MoaMitra')}}" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Moa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-cart-arrow-down"></i>
                                <p>
                                    Transaksi
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Kotak Masuk</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-bar-chart"></i>
                                <p>
                                    Laporan
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>Data Order</p>
                                    </a>
                                </li>
                            </ul> -->
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper mastermenu">
            <!-- =============================================== -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- <img style="width: 600px;position:absolute;top: 195px;margin-left:200px;opacity: 0.1" src="{{asset ('assets/gambar/logoudb.png')}}" alt=""> -->
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2019.</strong>
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset ('/adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <!-- Bootstrap 4 -->
    <script src=" {{asset ('/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src=" {{ asset ('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset ('/adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src=" {{asset ('/adminlte/plugins/fastclick/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset ('/adminlte/js/adminlte.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('script')
</body>

</html>
