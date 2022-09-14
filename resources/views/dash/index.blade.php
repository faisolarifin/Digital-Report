@extends('templates.admin', ['title' => 'Dashboard'])

@section('content')
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 px-sm-0">
                                    <h6 class="text-muted font-semibold">Saldo Awal</h6>
                                    <h6 class="font-extrabold mb-0 xp-1">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 px-sm-0">
                                    <h6 class="text-muted font-semibold">Sisa Saldo</h6>
                                    <h6 class="font-extrabold mb-0 xp-2">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 px-sm-0">
                                    <h6 class="text-muted font-semibold">Total Debit</h6>
                                    <h6 class="font-extrabold mb-0 xp-3">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8 px-sm-0">
                                    <h6 class="text-muted font-semibold">Total Kredit</h6>
                                    <h6 class="font-extrabold mb-0 xp-4">0</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kas Tahunan</h4>
                        </div>
                        <div class="card-body">
                            <div id="chart-1"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4>Debit Pertahun</h4>
                </div>
                <div class="card-body">
                    <div id="chart-2"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Kredit Pertahun</h4>
                </div>
                <div class="card-body">
                    <div id="chart-3"></div>
                </div>
            </div>
        </div>
    </section>

    <script>
        //Number Format
        function currency(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '.00';
        }

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: `{{ route('api.dash') }}`,
                type: "GET",
                data: {
                    tahun_id: "{{request()->tahun_id}}",
                },
                dataType: 'json',
                success: function(res) {
                    periode = []
                    kredit = []
                    debit = []
                    tahun = []
                    thn_kredit = []
                    thn_debit = []

                    if (Object.keys(res).length > 0) {
                        $.each(res.grafik, function(idx, row){
                            periode.push(row.bulan);
                            kredit.push(parseInt(row.kredit ?? 0));
                            debit.push(parseInt(row.debit ?? 0));
                        })
                        $.each(res.tahunan, function(idx, row){
                            tahun.push(row.thn);
                            thn_kredit.push(parseInt(row.kredit ?? 0));
                            thn_debit.push(parseInt(row.debit ?? 0));
                        })

                        const last = res.grafik.slice(-1)[0];
                        $('.xp-1').text('Rp.' + currency(parseInt(last?.saldo_awal ?? 0)));
                        $('.xp-2').text('Rp.' + currency(parseInt(last?.sisa_saldo ?? 0)));
                        $('.xp-3').text('Rp.' + currency(parseInt(last?.debit ?? 0)));
                        $('.xp-4').text('Rp.' + currency(parseInt(last?.kredit ?? 0)));
                    }

                    var options1 = {
                        annotations: {
                            position: 'back'
                        },
                        dataLabels: {
                            enabled:false
                        },
                        chart: {
                            type: 'bar',
                            height: 300
                        },
                        fill: {
                            opacity:1
                        },
                        plotOptions: {
                        },
                        series: [{
                            name: 'Debit',
                            data: debit,
                        }, {
                            name: 'Kredit',
                            data: kredit,
                        }],
                        colors: ['#435ebe','#433221'],
                        xaxis: {
                            categories: periode,
                        },
                    }
                    var chart1 = new ApexCharts(document.querySelector("#chart-1"), options1);
                    chart1.render();

                    colors = [];
                    for(i=0;i<tahun.length;i++) {
                        const randomColor = Math.floor(Math.random()*16777215).toString(16);
                        colors.push("#" + randomColor);
                    }

                    let options2  = {
                        series: thn_debit,
                        labels: tahun,
                        colors: colors,
                        chart: {
                            type: 'donut',
                            width: '100%',
                            height:'350px'
                        },
                        legend: {
                            position: 'bottom'
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '30%'
                                }
                            }
                        }
                    }
                    var chart2 = new ApexCharts(document.getElementById('chart-2'), options2)
                    chart2.render()

                    let option3  = {
                        series: thn_kredit,
                        labels: tahun,
                        colors: colors,
                        chart: {
                            type: 'donut',
                            width: '100%',
                            height:'350px'
                        },
                        legend: {
                            position: 'bottom'
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '30%'
                                }
                            }
                        }
                    }
                    var chart3 = new ApexCharts(document.getElementById('chart-3'), option3)
                    chart3.render()
                }
            });

            function showMenu() {

                $.ajax({
                    url: `{{ route('api.tahun') }}`,
                    type: "GET",
                    dataType: 'json',
                    success: function(res) {
                        if (Object.keys(res).length > 0) {
                            dom = '<a href="{{route('rep.kas')}}"><li class="sidebar-title d-flex justify-content-between align-items-center">' +
                                'PERIODE</li></a>';
                            $.each(res.data, function(key, row) {
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
                        }
                    }
                });
            }
            showMenu()

        });
    </script>
    <script src="assets/vendors/apexcharts/apexcharts.js"></script>

@endsection
