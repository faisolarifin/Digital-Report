<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashtreme - E-Report</title>
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- animate CSS-->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- Sidebar CSS-->
    <link href="{{ asset('assets/css/sidebar-menu.css') }}" rel="stylesheet" />
    <!-- Custom Style-->
    <link href="{{ asset('assets/css/app-style.css') }}" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,500;1,200&display=swap"
        rel="stylesheet">

    <style>
        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        button,
        a,
        td,
        th,
        input,
        textarea,
        select option {
            font-family: 'Poppins';
        }

        .modal-dialog p,
        .modal-dialog h5 {
            color: #000;
        }
        .sidebar-menu {
            overflow: auto;
            max-height: 90vh !important;
        }

        .modal-dialog .form-control {
            border: 1px solid #ced4da;
            color: #495057 !important;
            background-color: #fff;
        }
        .modal-dialog .form-label {
            color: #495057;
        }

        .modal-dialog select option {
            background-color: #fff;
        }

        .sidebar-menu li {
            text-align: center;
        }
        
        .sidebar-menu a {
            padding-left: 0 !important;
            padding-left: 14px !important;
            padding-right: 14px !important;
        }

        #sidebar-wrapper {
            width: 160px;
        }

        .content-wrapper {
            margin-left: 170px;
        }

        .toggle-menu i {
            margin-left: 175px;
        }
        .btn-y {
            padding: 0;
            background: transparent;
            border: 0;
            color: #fff;
        }
        .footer {
            left: 0;
        }
    </style>

</head>

<body class="bg-theme bg-theme1">

    <!-- Start wrapper-->
    <div id="wrapper">

        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo">
                <a href="/">
                    <img src="{{asset('assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
                    <h5 class="logo-text">E-Report</h5>
                </a>
            </div>
            <ul class="sidebar-menu do-nicescrol">
                <li class="sidebar-header text-center">PERIODE LAPORAN</li>
                <li>
                    <button class="btn btn-sm btn-info my-2" data-toggle="modal" data-target="#staticBackdrop">
                        <span><i class="icon-plus m-0"></i> baru</span>
                    </button>
                </li>             
                @foreach ($tahun->sortByDesc('thn') as $row) <!-- $tahun, $tahun_id, $periode_id mendapatkan dari TahunServiceProvider -->
                    <li {{$tahun_id == $row->id_thn ? 'class=active' : ''}}>
                        <a class="d-flex justify-content-between" href="{{route('rep.kas', ['thn' => $row->id_thn])}}">
                            <span>&nbsp;</span>
                            <span>{{ $row->thn }}</span>
                            <form action="{{route('thn.d')}}" method="post" onsubmit="hapus(event)">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{$row->id_thn}}" name="kode">
                                <button class="btn-y"><i class="icon-trash m-0"></i></button>
                            </form>
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav class="navbar navbar-expand fixed-top">
                <ul class="navbar-nav mr-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link toggle-menu" href="javascript:void();">
                            <i class="icon-menu menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link waves-effect" href="{{ route('rep.kas') }}">
                            <i class="icon-chart m-0"></i>
                            REPORT</a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                        href="javascript:void();">
                        <i class="icon-user m-0"></i>
                        USERS</a>
                    </li>
                    <li class="nav-item dropdown-lg">
                        <a class="nav-link waves-effect" href="{{ route('rep.kas') }}">
                            <i class="icon-magnet m-0"></i>
                            UTILITY</a>
                    </li>
                </ul>

                <ul class="navbar-nav align-items-center right-nav-link">
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown"
                            href="#">
                            <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle"
                                    alt="user avatar"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item user-details">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <div class="avatar"><img class="align-self-start mr-3"
                                                src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                                        <div class="media-body">
                                            <h6 class="mt-2 user-title">Sarajhon Mccoy</h6>
                                            <p class="user-subtitle">mccoy@example.com</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="{{route('auth.logout')}}"><i class="icon-power mr-2"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <!--End topbar header-->

        <div class="clearfix"></div>

        <div class="content-wrapper">

            @yield('content')

        </div>
        <!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--Start footer-->
        <footer class="footer">
            <div class="container">
                <div class="text-center">
                    Copyright © {{ date('Y') }} E-Report
                </div>
            </div>
        </footer>
        <!--End footer-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">

                <p class="mb-0">Gaussion Texture</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p class="mb-0">Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>

            </div>
        </div>
        <!--end color switcher-->

    </div>
    <!--End wrapper-->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">TAMBAH PERIODE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('thn.s')}}" method="post">
                        @csrf
                        <div class="d-flex justify-content-center">
                            <select class="form-control" name="tahun" id="tahun">
                                @for ($y = date('Y'); $y > 2010; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                            <button class="btn btn-info ml-2">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- simplebar js -->
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.js') }}"></script>
    <!-- sidebar-menu js -->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <!-- Custom scripts -->
    <script src="{{ asset('assets/js/app-script.js') }}"></script>
    <script>
       function hapus(event)
        {
            if (confirm('Anda akan Menghapus Periode Laporan? \nSemua data Periode ini akan terhapus.')){return true;}
            else{event.stopPropagation();event.preventDefault();};
        }
    </script>

</body>

</html>
