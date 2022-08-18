<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="bulan">Periode</label>
            <input type="hidden" name="kode" id="kode">
            <select name="bulan" class="form-control form-control-sm" id="bulan">
                @foreach ($periode as $row)
                    <option value="{{ $row->id_periode }}"
                        {{ $row->id_periode == request()->periode_id ? 'selected' : '' }}>
                        {{ strtoupper($row->bulan) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
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
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal"
                   placeholder="Tanggal">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="jml_uang" name="jml_uang">Jumlah Uang</label>
            <input type="number" class="form-control form-control-sm" id="jml_uang" name="jml_uang"
                   placeholder="Jumlah Uang">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="kebutuhan">Kebutuhan</label>
            <textarea class="form-control form-control-sm" id="kebutuhan" placeholder="Kebutuhan" name="kebutuhan"></textarea>
        </div>
    </div>
</div>
