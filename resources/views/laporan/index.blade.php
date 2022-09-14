@extends('templates.admin', ['title' => 'Laporan'])

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Laporan</h3>
                <p class="text-subtitle text-muted text-capitalize"></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-sm-end">
                    <ol class="breadcrumb text-capitalize">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item">Laporan</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <p>Laporan</p>
                <div class="group">
                    <a href="{{route('rep.export.xls', request()->periode_id)}}" class="btn btn-sm btn-outline-success">Export excel</a>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-post">+ Tambah Baru
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Debit</th>
                        <th scope="col">Kredit</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody id="content">
                    <!--content of table-->
                    </tbody>
                </table>
            </div>
        </div>

    </section>

    <!--Form Modal Kas -->
    <div class="modal fade text-left" id="modal-post" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <form method="post" id="formSimpan">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kelola Kas</h5>
                        <button type="button" class="close rounded-pill"
                                data-bs-dismiss="modal" aria-label="Close">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('laporan.formKas')
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

    <script>
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //-------------

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

            function showMenu() {

                $.ajax({
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

            showMenu()

            $('body').on('submit', '#formTahun', function(e) {
                e.preventDefault()
                $.ajax({
                    url: "{{route('api.thn.s')}}",
                    type: "POST",
                    dataType: 'json',
                    data: $('#formTahun').serialize(),
                    success: function(res) {
                        $('#modal-post-tahun').modal('hide');
                        showMenu();
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
                            showMenu();
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
                        showMenu();
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

            //--------------------------------------------------------------------------

            $.ajax({
                url: "{{route('api.bread')}}",
                type: "POST",
                data: {
                    periode_id: "{{request()->periode_id}}",
                    tahun_id: "{{request()->tahun_id}}",
                },
                success: function (res) {
                    if (res[0] != null) {
                        res = res[0];
                        $('.text-subtitle').text(`Bulan ${res.bulan} ${res.thn}`);
                        $('.breadcrumb').append(`<li class="breadcrumb-item">${res.thn}</li>`)
                            .append(`<li class="breadcrumb-item">${res.bulan}</li>`)
                    }
                },
            });

            $('#modal-post').on('hide.bs.modal', function (e) {
                $(this).find('form').attr('id', 'formSimpan');
                $(this).find('.modal-title').text('Kelola Kas');
                $('#formSimpan').trigger("reset");
                $('#formUpdate').trigger("reset");
            })

            $('body').on('submit', '#formSimpan', function (e) {
                e.preventDefault()
                $.ajax({
                    url: "{{route('api.kas.s')}}",
                    type: "POST",
                    dataType: 'json',
                    data: $('#formSimpan').serialize(),
                    success: function (res) {
                        $('#modal-post').modal('hide');
                        showData();
                    },
                });
            });

            $('body').on('click', '.hapus', function (e) {
                var _id = $(this).data('id')
                if (confirm("Data akan menghapus data?")) {
                    $.ajax({
                        url: "{{ route('api.kas.d') }}",
                        type: "DELETE",
                        dataType: 'json',
                        data: {
                            kode: _id
                        },
                        success: function (res) {
                            showData();
                        },
                    });
                }
            })

            $('body').on('click', '.edit', function (e) {
                var _id = $(this).data('id')

                $('#modal-post').modal('show');
                $('#modal-post form').attr('id', 'formUpdate')
                $('#modal-post .modal-title').text('Edit Kas')

                var url = "{{ route('api.kas.r', ':id') }}";
                url = url.replace(':id', _id);
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    success: function (res) {
                        $('#kode').val(res.id_kas);
                        $('#bulan').val(res.id_periode);
                        if (res.tipe == 'kredit') $('#kredit').attr('checked', true)
                        else if (res.tipe == 'debit') $('#debit').attr('checked', true)
                        $('#jml_uang').val(res.jml_uang);
                        $('#tanggal').val(res.tanggal);
                        $('#kebutuhan').val(res.kebutuhan);
                    },
                });
            })

            $('body').on('submit', '#formUpdate', function (e) {
                e.preventDefault()
                $.ajax({
                    url: "{{ route('api.kas.u') }}",
                    type: "PUT",
                    dataType: 'json',
                    data: $('#formUpdate').serialize(),
                    success: function (res) {
                        $('#modal-post').modal('hide');
                        showData();
                    },
                });
            });

            $('body').on('click', '.hapus-bulan', function (e) {
                if (confirm("Anda akan menghapus semua data periode ini ?")) {
                    $.ajax({
                        url: "{{ route('api.periode.d') }}",
                        type: "DELETE",
                        dataType: 'json',
                        data: {
                            kode: "{{request()->periode_id}}"
                        },
                        success: function (res) {
                            window.location = "{{route('rep.kas')}}";
                        },
                    });
                }
            })

            $('body').on('click', '.edit-bulan', function (e) {
                var _id = "{{request()->periode_id}}"

                $('#modal-post-bulan').modal('show');
                $('#modal-post-bulan form').attr('id', 'formBulanUpdate')
                $('#modal-post-bulan .modal-title').text('Edit Periode')

                var url = "{{ route('api.periode.r', ':id') }}";
                url = url.replace(':id', _id);
                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: 'json',
                    success: function (res) {
                        $('#kode-periode').val(res.id_periode)
                        $('#tahun-periode').val(res.id_thn)
                        $('#bulan-periode').val(res.bulan)
                        $('#saldo_awal').val(res.saldo_awal)
                        $('#sisa_saldo').val(res.sisa_saldo)
                        $('#ket').val(res.ket)
                    },
                });
            });

            $('body').on('submit', '#formBulanUpdate', function (e) {
                e.preventDefault()
                $.ajax({
                    url: "{{ route('api.periode.u') }}",
                    type: "PUT",
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (res) {
                        $('#modal-post-bulan').modal('hide');
                        showData();
                    },
                });
            });

            function showData() {
                $.ajax({
                    url: "{{ route('api.kas.r') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        periode_id: "{{request()->periode_id}}"
                    },
                    success: function (res) {
                        if (res.saldo == null) return;
                        dom = '';
                        dom += `<tr>
                                <td>1</td>
                                <td>-</td>
                                <td>${res.saldo.ket}</td>
                                <td>Rp. ${currency(parseInt(res.saldo.saldo_awal))}</td>
                                <td>-</td>
                                <td>Rp. ${currency(parseInt(res.saldo.saldo_awal))}</td>
                                <td>
                                    <button class="btn btn-sm btn-info p-2 edit-bulan">Edit</button>

                                    <button type="button" class="btn btn-sm btn-danger p-2 hapus-bulan">Hapus</button>
                                </td>
                            </tr>`;
                        saldo = parseInt(res.saldo.saldo_awal);
                        $.each(res.kas, function (index, row) {
                            dom += `<tr>
                                <td>${++index}</td>
                                <td>${date(row.tanggal)}</td>
                                <td>${row.kebutuhan}</td>`;
                            dom += `<td>`;
                            dom += (row.tipe == 'debit') ? 'Rp. ' + currency(parseInt(row.jml_uang)) : '-';
                            dom += `</td>`;
                            dom += `<td>`;
                            dom += (row.tipe == 'kredit') ? 'Rp. ' + currency(parseInt(row.jml_uang)) : '-';
                            dom += `</td>`;
                            dom += `<td>`;
                            dom += (row.tipe == 'debit') ? 'Rp. ' + currency(saldo += parseInt(row.jml_uang)) : '';
                            dom += (row.tipe == 'kredit') ? 'Rp. ' + currency(saldo -= parseInt(row.jml_uang)) : '';
                            dom += `</td>`;
                            dom += `<td>
                                    <button class="btn btn-sm btn-info p-2 edit" data-id="${row.id_kas}">Edit</button>
                                    <button class="btn btn-sm btn-danger p-2 hapus" data-id="${row.id_kas}">Hapus</button>
                                </td>
                            </tr>`;
                        })
                        $('#content').html(dom);
                    },
                });
            }

            showData()

        });
    </script>
@endsection
