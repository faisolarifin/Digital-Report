@extends('templates.admin', ['tahun_id' => $tahun_id])

@section('content')
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title my-auto">Kelola Kas</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            @foreach ($periode as $row)
                                <a href="{{ route('rep.kas', ['thn' => $tahun_id, 'bln' => $row->id_periode]) }}"><button
                                        class="btn btn-sm {{ $periode_id == $row->id_periode ? 'btn-dark' : 'btn-light' }}">{{ $row->bulan }}</button></a>
                            @endforeach
                            <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalBulan"><i
                                    class="icon-plus m-0"></i> baru</button>
                        </div>
                        <hr>
                        <form action="{{route('rep.kas.s', ['thn' => $tahun_id, 'bln' => $periode_id])}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="bulan">Periode</label>
                                        <select name="bulan" class="form-control" id="bulan">
                                            @foreach ($periode as $row)
                                                <option value="{{ $row->id_periode }}"
                                                    {{ $row->id_periode == $periode_id ? 'selected' : '' }}>
                                                    {{ strtoupper($row->bulan) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            placeholder="Enter Your Email Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="kebutuhan">Kebutuhan</label>
                                        <textarea class="form-control" id="kebutuhan" placeholder="Kebutuhan" name="kebutuhan"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-2">
                                        <label for="input-1">Tipe</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe" id="debit"
                                                value="debit">
                                            <label class="form-check-label" for="debit">
                                                Debit
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe" id="kredit"
                                                value="kredit">
                                            <label class="form-check-label" for="kredit">
                                                Kredit
                                            </label>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="jml_uang" name="jml_uang">Jumlah Uang</label>
                                        <input type="number" class="form-control" id="jml_uang" name="jml_uang"
                                            placeholder="Jumlah Uang">
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-light">Simpan</button>
                                        <button type="reset" class="btn btn-light">Reset</button>
                                    </div>
                                </div>

                            </div>
                        </form>
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

    <!-- Modal -->
    <div class="modal fade" id="modalBulan" data-backdrop="static" data-keyboard="false" tabindex="-1"
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

    <script>
        const saldo_awal = document.querySelector('.modal-dialog #saldo_awal')
        const sisa_saldo = document.querySelector('.modal-dialog #sisa_saldo')

        saldo_awal.oninput = function() {
            sisa_saldo.value = this.value
        }
    </script>
@endsection
