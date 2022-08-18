@extends('templates.admin', ['tahun_id' => $tahun_id])

@section('content')
    <div class="container-fluid">

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title my-auto">Edit Kas</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('rep.kas.u', ['thn' => $tahun_id, 'bln' => $periode_id])}}" method="post">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="kode_kas" value="{{$kas->id_kas}}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="bulan">Periode</label>
                                        <select name="bulan" class="form-control" id="bulan">
                                            @foreach ($periode as $row)
                                                <option value="{{ $row->id_periode }}"
                                                    {{ $row->id_periode == $kas->id_periode ? 'selected' : '' }}>
                                                    {{ strtoupper($row->bulan) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            value="{{$kas->tanggal}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="kebutuhan">Kebutuhan</label>
                                        <textarea class="form-control" id="kebutuhan" placeholder="Kebutuhan" name="kebutuhan">{{$kas->kebutuhan}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-2">
                                        <label for="input-1">Tipe</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe" id="debit"
                                                value="debit" {{ $kas->tipe == 'debit' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="debit">
                                                Debit
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="tipe" id="kredit"
                                                value="kredit" {{ $kas->tipe == 'kredit' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="kredit">
                                                Kredit
                                            </label>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="jml_uang" name="jml_uang">Jumlah Uang</label>
                                        <input type="number" class="form-control" id="jml_uang" name="jml_uang"
                                            placeholder="Jumlah Uang" value="{{$kas->jml_uang}}">
                                    </div>
                                    <div class="form-group mt-5">
                                        <button type="submit" class="btn btn-light">Update</button>
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

    <script>
        const saldo_awal = document.querySelector('.modal-dialog #saldo_awal')
        const sisa_saldo = document.querySelector('.modal-dialog #sisa_saldo')

        saldo_awal.oninput = function() {
            sisa_saldo.value = this.value
        }
    </script>
@endsection
