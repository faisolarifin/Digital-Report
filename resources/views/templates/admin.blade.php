<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}} | Kaspro</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('assets/images/pavicon/money.png') }}" type="image/png">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <div id="app">
        <div id="contextmenu" class="shadow-sm rounded">
            <ul class="list-menu">
                <li data-bs-toggle="modal" data-bs-target="#modal-post-bulan"><i class="bi bi-plus-circle"></i> Baru</li>
                <li class="delete-tahun"><i class="bi bi-trash"></i> Hapus</li>
            </ul>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid navbar-m">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rep.kas') }}">LAPORAN</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users')}}">USERS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('backup')}}">BACKUP</a>
                    </li>
                </ul>
                <header class="mb-2 d-flex flex-row align-items-center">
                    <a href="#" class="burger-btn d-block d-lg-none">
                        <i class="bi bi-justify fs-3"></i>
                    </a>
                    <a href="{{route('auth.logout')}}" class="fs-5 ms-2 d-block d-lg-none">
                        <i class="bi bi-box-arrow-right"></i>
                    </a>
                </header>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="dropdown ms-auto">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-1"> {{Auth::user()->name}}</span>
                            <img src="{{asset('assets/images/faces/1.jpg')}}" alt="icon" class="rounded-circle" width="30px">
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear"></i> Konfigurasi</a></li>
                            <li><a class="dropdown-item" href="{{route('auth.logout')}}"><i class="bi bi-box-arrow-right"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="toggler d-block d-lg-none">
                    <a href="#" class="sidebar-hide"><i
                            class="bi bi-x bi-middle"></i></a>
                </div>
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo">
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">

            <div class="page-heading">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Kaspro</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
