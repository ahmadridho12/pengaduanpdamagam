<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
    <!-- Load your custom CSS file -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Adjust the path accordingly -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-FZpZegd8+aWVll5fCxk8NBvJdGhE9i4TBUC+Vp5zDQ6H4zjpj+NHUC3JxLr+ogB2FW5w9zmAD0L88QeDWkHgPQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @yield('css')

    <style>
        .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 100;
        overflow: hidden; /* Use 'hidden' to disable scrolling */
    }
        
        .btn-purple {
            background: #233e99;
            border: 1px solid #ffffff;
            color: #fff;
        }

        .btn-purple:hover {
            background: #5670c4;
            border: 1px solid #233e99;S
            color: #fff;
        }
        .sidebar-header {
         display: flex;
         align-items: center;
        }

        .logo-img {
            margin-right: 10px; /* Atur margin sesuai kebutuhan */
        }

        .text-container {
            display: flex;
            flex-direction: column;
        }

        .text-container h5 {
            margin: 0;
        }

        .text-container h5 span {
            font-size: 80%; /* Atur ukuran font sesuai kebutuhan */
        }
        .list-unstyled.components li a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-left: 8px;
        }

        .list-unstyled.components li a i {
            margin-right: 8px; /* Ruang antara ikon dan teks */
        }

        .list-unstyled.components li.active a {
            background-color: #f8f9fa; /* Gaya untuk item aktif */
            color: #007bff;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
</head>

<body class="fixed">

    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logopdam.png') }}" alt="TIRTA ANTOKAN Logo" class="logo-img" style="width: 80px;">
                <div class="text-container">
                    <h5 class="mb-0">PERUMDA <br><span>Tirta Antokan</span></h5>
                </div>
            </div>

            <ul class="list-unstyled components">
                @if (Auth::guard('admin')->user()->level == 'admin')
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="{{ Request::is('admin/pengaduan') ? 'active' : '' }}">
                    <a href="{{ route('pengaduan.index') }}">
                        <i class="fas fa-exclamation-triangle"></i> Pengaduan
                    </a>
                </li>
                <li class="{{ Request::is('admin/petugas') ? 'active' : '' }}">
                    <a href="{{ route('petugas.index') }}">
                        <i class="fas fa-users"></i> Petugas
                    </a>
                </li>
                <li class="{{ Request::is('admin/laporan') ? 'active' : '' }}">
                    <a href="{{ route('laporan.index') }}">
                        <i class="fas fa-file-alt"></i> Laporan
                    </a>
                </li>
                @elseif(Auth::guard('admin')->user()->level == 'petugas')
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="{{ Request::is('admin/pengaduan') ? 'active' : '' }}">
                    <a href="{{ route('pengaduan.index') }}">
                        <i class="fas fa-exclamation-triangle"></i> Pengaduan
                    </a>
                </li>
                @endif
                
            </ul>
            
        </nav>


        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="navbar-btn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="ml-2">@yield('header')</div>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <a href="{{ route('admin.logout') }}" class="btn btn-white btn-sm">{{ Auth::guard('admin')->user()->nama_petugas }}</a>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
        </div>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });

    </script>
    @stack('scripts')

    @yield('js')
    <footer class="footer mt-4" style="background-color: #233e99; color: white; padding: 20px 0;">
        <div class="container text-center">
            <small>© 2024 TIRTA ANTOKAN. All rights reserved.</small>
        </div>
    </footer>
    </body>

</html>
