<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Digital Report</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-datatables/style.css') }}">

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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('rep.kas') }}">LAPORAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('users')}}">USERS</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                BACKUP
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="{{route('backup')}}">Export Db</a></li>
                                <li><a class="dropdown-item" href="#">Import Db</a></li>
                            </ul>
                        </li>
                    </ul>
                        <div class="dropdown">
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
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"
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

            <div class="page-heading">
                @yield('content')
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

    <!--Form Modal Tahun -->
    <div class="modal fade text-left" id="modal-post-tahun" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tahun</h5>
                    <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="formTahun">
                        <div class="d-flex justify-content-center">
                            <select class="form-select form-select-sm" name="tahun" id="tahun">
                                @for ($y = date('Y'); $y > 2010; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary ms-2">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!--Form Modal Bulan -->
    <div class="modal fade text-left" id="modal-post-bulan" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form method="post" id="formBulan">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Periode</h5>
                        <button type="button" class="close rounded-pill"
                                data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('laporan.formPeriode')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-sm btn-primary ml-1">
                            Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/simple-datatables/simple-datatables.js') }}"></script>
    <script>
        //Fungsi Date
        function date(date) {
            date = date.split('-')
            return date[2]+'/'+date[1]+'/'+date[0]
        }
        //Number Format
        function currency(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '.00';
        }
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
        $('.dataTable-selector').addClass('form-select-sm')
        $('.dataTable-input').removeClass('dataTable-input').addClass('form-control').addClass('form-control-sm')

        function showData() {

            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `{{ route('api.tahun') }}`,
            type: "GET",
            dataType: 'json',
            success: function(res) {
                if (Object.keys(res).length > 0) {
                    option = '';
                    dom = '<li class="sidebar-title d-flex justify-content-between align-items-center">PERIODE ' +
                        '<button class="btn-y" data-bs-toggle="modal" data-bs-target="#modal-post-tahun">' +
                        '<i class="bi bi-plus-circle"></i></button></li>';
                    $.each(res.data, function(key, row) {
                        option += `<option value="${row.id_thn}">${row.thn}</option>`;
                        dom += `<li class="sidebar-item has-sub">`;
                        dom += `<a href="#" class='sidebar-link' data-id="${row.id_thn}">
                                    <i class="bi bi-grid-fill"></i>
                                    <span>${row.thn}</span>
                                </a>`;
                        display = String(row.id_thn) == "{{Request()->tahun_id}}" ? 'block' : 'none';
                        dom += `<ul class="submenu " style="display: ${display}">`;

                        $.each(row.bulan, function(idx, bln) {
                            url = "{{ route('rep.kas', [':thn', ':bln']) }}";
                            url = url.replace(':thn', row.id_thn).replace(':bln', bln.id_periode);
                            dom += `<li class="submenu-item">
                                        <a href="${url}">${bln.bulan}</a>
                                    </li>`;
                        })
                        dom += `</ul>`;
                        dom += `</li>`;
                    });

                    $('.menu').html(dom);
                    $('#tahun-periode').html(option);
                }
            }
            });
        }

        showData()

        $('body').on('submit', '#formTahun', function(e) {
            e.preventDefault()
            $.ajax({
                url: "{{route('api.thn.s')}}",
                type: "POST",
                dataType: 'json',
                data: $('#formTahun').serialize(),
                success: function(res) {
                    $('#modal-post-tahun').modal('hide');
                    showData();
                },
            });
        });

        $('body').on('click', '.delete-tahun', function(e) {
            var _id = $(this).attr('data-id')
            if (confirm("Data akan menghapus periode?")) {
                $.ajax({
                    url: "{{ route('api.thn.d') }}",
                    type: "DELETE",
                    dataType: 'json',
                    data: {
                        kode: _id
                    },
                    success: function(res) {
                        showData();
                    },
                });
            }
        });

        $('#modal-post-bulan').on('show.bs.modal', function(event) {
            var _id = event.relatedTarget?.getAttribute('data-id')
            $(this).find('#tahun-periode').val(_id)
        })
        $('#modal-post-bulan').on('hide.bs.modal', function(e) {
            $(this).find('form').attr('id', 'formBulan');
            $(this).find('.modal-title').text('Tambah Periode')

            $('#formBulan').trigger("reset");
            $('#formBulanUpdate').trigger("reset");
        })

        $('body').on('submit', '#formBulan', function(e) {
            e.preventDefault()
            $.ajax({
                url: "{{route('api.periode.s')}}",
                type: "POST",
                dataType: 'json',
                data: $('#formBulan').serialize(),
                success: function(res) {
                    $('#modal-post-bulan').modal('hide');
                    showData();
                },
            });

        });

        $('body').on('contextmenu', '.sidebar-link', function(event) {
            event.preventDefault();
            var _id = $(this).attr('data-id');
            var ctxMenu = $("#contextmenu");
            ctxMenu.css("display", "block");
            ctxMenu.css("left", (event.pageX - 10)+"px");
            ctxMenu.css("top", (event.pageY - 10)+"px");
            ctxMenu.find('li').attr('data-id', _id);
        })
        $('body').on('click', function(event) {
            var ctxMenu = $("#contextmenu");
            ctxMenu.css("display", "none");
            ctxMenu.css("left", "");
            ctxMenu.css("top", "");
            ctxMenu.find('li').removeAttr('data-id');
        })

        $('body').on('input', '#saldo_awal', function() {
            $('#sisa_saldo').val($(this).val())
        });

    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
