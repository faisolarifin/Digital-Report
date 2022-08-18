@extends('templates.admin')

@section('content')
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title my-auto">Kelola Kas</h5>
                        <div class="w-50 text-right">
                            <button type="submit" class="btn btn-light px-5"><i class="icon-export m-0"></i> export
                                excel</button>
                            <a
                                href="{{ $periode_id != null ? route('rep.kas.t', ['thn' => $tahun_id, 'bln' => $periode_id]) : '#' }}"><button
                                    class="btn btn-light px-5"><i class="icon-plus m-0"></i>
                                    Tambah Kas</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @foreach ($periode as $row)
                                <a href="{{ route('rep.kas', ['thn' => $tahun_id, 'bln' => $row->id_periode]) }}"><button
                                        class="btn btn-sm {{ $periode_id == $row->id_periode ? 'btn-dark' : 'btn-light' }}">{{ $row->bulan }}</button>
                                </a>
                            @endforeach
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalTambahBulan"><i
                                    class="icon-plus m-0"></i> baru</button>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
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
                                <tbody>
                                    @if ($c_saldo != null)
                                        <tr>
                                            <td>1</td>
                                            <td>-</td>
                                            <td>{{ $c_saldo->ket }}</td>
                                            <td>Rp. {{ number_format($c_saldo->saldo_awal, 2) }}</td>
                                            <td>-</td>
                                            <td>Rp. {{ number_format($c_saldo->saldo_awal, 2) }}</td>
                                            <td>
                                                <button class="btn btn-light p-2" data-toggle="modal"
                                                    data-target="#modalEditBulan" id="editBulan"><i class="icon-pencil m-0"></i></button>
                                                <form class="d-inline"
                                                    action="{{ route('periode.d', ['thn' => $tahun_id]) }}" method="post"
                                                    onsubmit="hapusPeriode(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="kode" value="{{ $c_saldo->id_periode }}">
                                                    <button type="submit" class="btn btn-light p-2"><i
                                                            class='icon-trash m-0'></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    @php($no = 1)
                                    @php($saldo = @$c_saldo->saldo_awal)
                                    @foreach ($kas as $row)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ Date::tglReverse($row->tanggal) }}</td>
                                            <td>{{ $row->kebutuhan }}</td>
                                            <td>{{ $row->tipe == 'debit' ? 'Rp. ' . number_format($row->jml_uang, 2) : '-' }}
                                            </td>
                                            <td>{{ $row->tipe == 'kredit' ? 'Rp. ' . number_format($row->jml_uang, 2) : '-' }}
                                            </td>
                                            <td>
                                                @if ($row->tipe == 'debit')
                                                    {{ 'Rp ' . number_format($saldo += $row->jml_uang, 2) }}
                                                @elseif ($row->tipe == 'kredit')
                                                    {{ 'Rp ' . number_format($saldo -= $row->jml_uang, 2) }}
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-light p-2"
                                                    href="{{ route('rep.kas.e', ['thn' => $tahun_id, 'bln' => $periode_id, 'id' => $row->id_kas]) }}"><i
                                                        class="icon-pencil m-0"></i></a>
                                                <form class="d-inline"
                                                    action="{{ route('rep.kas.d', ['thn' => $tahun_id, 'bln' => $periode_id]) }}"
                                                    method="post" onsubmit="eventHapus(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="kode_kas" value="{{ $row->id_kas }}">
                                                    <button type="submit" class="btn btn-light p-2"><i
                                                            class='icon-trash m-0'></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--End Row-->

        <!--start overlay-->
        <div class="overlay toggle-menu"></div>
        <!--end overlay-->

    </div>
    <!-- End container-fluid-->

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahBulan" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('periode.s', ['thn' => $tahun_id])}}" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">TAMBAH PERIODE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    @include('laporan.formPeriode')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-info ml-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEditBulan" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{route('periode.u', ['thn' => $tahun_id])}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">EDIT PERIODE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="kode" id="kode">

                    @include('laporan.formPeriode')

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-info ml-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const saldo_awal = document.querySelector('.modal-dialog #saldo_awal')
        const sisa_saldo = document.querySelector('.modal-dialog #sisa_saldo')

        saldo_awal.oninput = function() {
            sisa_saldo.value = this.value
        }

        function eventHapus(event) {
            if (confirm('Anda akan menghapus kas?')) {
                return true;
            } else {
                event.stopPropagation();
                event.preventDefault();
            };
        }

        function hapusPeriode(event) {
            if (confirm('Anda akan menghapus periode bulan? \nSemua kas bulan ini akan terhapus.')) {
                return true;
            } else {
                event.stopPropagation();
                event.preventDefault();
            };
        }

        @if ($c_saldo != null)
        var btnEdit = document.getElementById('editBulan')
        var modalEdit = document.getElementById('modalEditBulan')
        btnEdit.onclick = function()
        {
            modalEdit.querySelector('#kode').value = "{{$c_saldo->id_periode}}"
            modalEdit.querySelector('#tahun').value = "{{$c_saldo->id_thn}}"
            modalEdit.querySelector('#bulan').value = "{{$c_saldo->bulan}}"
            modalEdit.querySelector('#saldo_awal').value = "{{$c_saldo->saldo_awal}}"
            modalEdit.querySelector('#sisa_saldo').value = "{{$c_saldo->sisa_saldo}}"
            modalEdit.querySelector('#ket').value = "{{$c_saldo->ket}}"
        }
        @endif
    </script>
@endsection
