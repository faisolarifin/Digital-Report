<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg" type="image/x-icon') }}">
    <style>
        .sidebar-wrapper {
            width: 200px;
        }
        .sidebar-wrapper .sidebar-header {
            padding: 1rem 2.5rem 0.5rem !important;
        }
        .sidebar-wrapper .menu {
            padding: 0 1.5em;
        }
        .sidebar-wrapper .menu .sidebar-title {
            font-size: 0.9em;
            text-transform: uppercase;
            margin-bottom: .2em;
        }
        .sidebar-wrapper .menu .sidebar-link {
            padding: .5em 1em;
        }
        .sidebar-wrapper .menu .sidebar-item a {
            font-size: 0.9em;
        }
        .sidebar-wrapper .menu .sidebar-link span {
            margin-left: 0.3em;
        }
        .sidebar-wrapper .menu .sidebar-item.has-sub .sidebar-link::after {
            top: 9px;
        }
        .sidebar-wrapper .menu .submenu {
            padding-left: .3em;
        }
        .sidebar-wrapper .menu .submenu .submenu-item a {
            padding-top: .5em;
            padding-bottom: .5em;
        }
        #main {
            margin-left: 200px;
            padding-top: 1em;
        }
        .page-heading h3 {
            font-size: 1.4em;
            margin-bottom: 0;
        }
        .page-heading p {
            margin-bottom: 0.8em;
        }
        @media (min-width: 991.98px) {
            .navbar-m {
                margin-left: 200px;
            }
        }
        .navbar {
            height: 65px;
        }
        table td {
            font-size: 0.86em;
        }
        .card .card-header {
            padding-bottom: .9em;
        }
        .card .dataTable-top {
            padding: 0 0 .4em 0;
        }
        .navbar a {
            font-weight: 600 !important;
            color: #25396f !important;
            font-size: .9em;
        }

        #contextMenu {
            display:none;
            width: 120px;
            position:absolute;
            z-index:100;
            left:0px;
            top:0px;
            background-color:white;
        }
        #contextMenu .menu {
            list-style: none;
            font-weight:normal;
            white-space:nowrap;
            padding: 0;
            margin: 0;
        }
        #contextMenu .menu li {
            padding: .4em .8em;
        }#contextMenu .menu li:hover {
            background: #e1e1e1;
        }
    </style>
</head>

<body>

    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container-fluid navbar-m">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">LAPORAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">USERS</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                BACKUP
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Export Db</a></li>
                                <li><a class="dropdown-item" href="#">Import Db</a></li>
                            </ul>
                        </li>
                    </ul>
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-1"> Dropdown</span>
                                <img src="{{asset('assets/images/faces/1.jpg')}}" alt="icon" class="rounded-circle" width="30px">
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                            </ul>
                        </div>
                </div>
            </div>
        </nav>

        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"
                                    srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="index.html" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>2022</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="component-alert.html">Januari</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="component-badge.html">Februari</a>
                                </li>

                            </ul>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


            <div id="contextMenu" class="shadow-sm rounded">
                <ul class="menu">
                    <li>Edit</li>
                    <li>Hapus</li>
                </ul>
            </div>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Laporan</h3>
                            <p class="text-subtitle text-muted">Bulan April 2022</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">DataTable</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Simple Datatable
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>vehicula.aliquet@semconsequat.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Dale</td>
                                        <td>fringilla.euismod.enim@quam.ca</td>
                                        <td>0500 527693</td>
                                        <td>New Quay</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nathaniel</td>
                                        <td>mi.Duis@diam.edu</td>
                                        <td>(012165) 76278</td>
                                        <td>Grumo Appula</td>
                                        <td>
                                            <span class="badge bg-danger">Inactive</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Darius</td>
                                        <td>velit@nec.com</td>
                                        <td>0309 690 7871</td>
                                        <td>Ways</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Oleg</td>
                                        <td>rhoncus.id@Aliquamauctorvelit.net</td>
                                        <td>0500 441046</td>
                                        <td>Rossignol</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kermit</td>
                                        <td>diam.Sed.diam@anteVivamusnon.org</td>
                                        <td>(01653) 27844</td>
                                        <td>Patna</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Jermaine</td>
                                        <td>sodales@nuncsit.org</td>
                                        <td>0800 528324</td>
                                        <td>Mold</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ferdinand</td>
                                        <td>gravida.molestie@tinciduntadipiscing.org</td>
                                        <td>(016977) 4107</td>
                                        <td>Marlborough</td>
                                        <td>
                                            <span class="badge bg-danger">Inactive</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kuame</td>
                                        <td>Quisque.purus@mauris.org</td>
                                        <td>(0151) 561 8896</td>
                                        <td>Tresigallo</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Deacon</td>
                                        <td>Duis.a.mi@sociisnatoquepenatibus.com</td>
                                        <td>07740 599321</td>
                                        <td>Karapınar</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Channing</td>
                                        <td>tempor.bibendum.Donec@ornarelectusante.ca</td>
                                        <td>0845 46 49</td>
                                        <td>Warrnambool</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Aladdin</td>
                                        <td>sem.ut@pellentesqueafacilisis.ca</td>
                                        <td>0800 1111</td>
                                        <td>Bothey</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cruz</td>
                                        <td>non@quisturpisvitae.ca</td>
                                        <td>07624 944915</td>
                                        <td>Shikarpur</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Keegan</td>
                                        <td>molestie.dapibus@condimentumDonecat.edu</td>
                                        <td>0800 200103</td>
                                        <td>Assen</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ray</td>
                                        <td>placerat.eget@sagittislobortis.edu</td>
                                        <td>(0112) 896 6829</td>
                                        <td>Hofors</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Maxwell</td>
                                        <td>diam@dapibus.org</td>
                                        <td>0334 836 4028</td>
                                        <td>Thane</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Carter</td>
                                        <td>urna.justo.faucibus@orci.com</td>
                                        <td>07079 826350</td>
                                        <td>Biez</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stone</td>
                                        <td>velit.Aliquam.nisl@sitametrisus.com</td>
                                        <td>0800 1111</td>
                                        <td>Olivar</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Berk</td>
                                        <td>fringilla.porttitor.vulputate@taciti.edu</td>
                                        <td>(0101) 043 2822</td>
                                        <td>Sanquhar</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Philip</td>
                                        <td>turpis@euenimEtiam.org</td>
                                        <td>0500 571108</td>
                                        <td>Okara</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kibo</td>
                                        <td>feugiat@urnajustofaucibus.co.uk</td>
                                        <td>07624 682306</td>
                                        <td>La Cisterna</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bruno</td>
                                        <td>elit.Etiam.laoreet@luctuslobortisClass.edu</td>
                                        <td>07624 869434</td>
                                        <td>Rocca d"Arce</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leonard</td>
                                        <td>blandit.enim.consequat@mollislectuspede.net</td>
                                        <td>0800 1111</td>
                                        <td>Lobbes</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hamilton</td>
                                        <td>mauris@diam.org</td>
                                        <td>0800 256 8788</td>
                                        <td>Sanzeno</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harding</td>
                                        <td>Lorem.ipsum.dolor@etnetuset.com</td>
                                        <td>0800 1111</td>
                                        <td>Obaix</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Emmanuel</td>
                                        <td>eget.lacus.Mauris@feugiatSednec.org</td>
                                        <td>(016977) 8208</td>
                                        <td>Saint-Remy-Geest</td>
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        var notepad = document.querySelector("body");
        notepad.addEventListener("contextmenu",function(event){
            event.preventDefault();
            var ctxMenu = document.getElementById("contextMenu");
            ctxMenu.style.display = "block";
            ctxMenu.style.left = (event.pageX - 10)+"px";
            ctxMenu.style.top = (event.pageY - 10)+"px";
        },false);
        notepad.addEventListener("click",function(event){
            var ctxMenu = document.getElementById("contextMenu");
            ctxMenu.style.display = "none";
            ctxMenu.style.left = "";
            ctxMenu.style.top = "";
        },false);

        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
        let select = document.querySelector('.dataTable-selector').classList.add('form-select-sm');
        let input = document.querySelector('.dataTable-input');
        input.classList.remove('dataTable-input');
        input.classList.add('form-control');
        input.classList.add('form-control-sm');
    </script>

{{--    <script src="{{ asset('assets/js/main.js') }}"></script>--}}
</body>

</html>
