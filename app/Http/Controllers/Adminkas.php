<?php

namespace App\Http\Controllers;

use App\Exports\LaporanExport;
use App\Http\Requests\LaporanRequest;
use App\Models\{Kas, SaldoPeriode, Tahun};
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class Adminkas extends Controller
{

    public function indexDataKas()
    {
        $periode = SaldoPeriode::whereHas('thn', function ($q) {
            $q->where([
                'id_user' => auth()->user()->id
            ]);
        })->where(['id_thn' => request()->tahun_id])->get();

        return view('laporan.index', compact('periode'));
    }

    public function exportExcel($id=null)
    {
        return Excel::download(new LaporanExport($id), 'laporan.xlsx');
    }

    public function getBread()
    {
        return response()->json([
            Tahun::join('rep_saldo_periode', 'rep_tahun.id_thn', '=', 'rep_saldo_periode.id_thn')
            ->where([
                'rep_tahun.id_user' => auth()->user()->id,
                'rep_tahun.id_thn' => request()->tahun_id,
                'rep_saldo_periode.id_periode' => request()->periode_id,
            ])->first([
                'rep_tahun.*',
                'rep_saldo_periode.bulan'
            ])
        ]);

    }

    //API PERIODE
    public function getPeriodeSaldo($id=null)
    {
        if ($id==null) return response()->json([
            SaldoPeriode::whereHas('thn', function ($q) {
                $q->where([
                    'id_user' => auth()->user()->id
                ]);
            })->where(['id_thn' => request()->tahun_id])->get(),
        ]);
        return response()->json(
            SaldoPeriode::whereHas('thn', function ($q) {
                $q->where([
                    'id_user' => auth()->user()->id
                ]);
            })->find($id)
        );
    }
    public function savePeriodeSaldo(Request $request)
    {
        SaldoPeriode::create([
            'id_thn' => $request->tahun,
            'bulan' => $request->bulan,
            'saldo_awal' => $request->saldo_awal,
            'sisa_saldo' => $request->sisa_saldo,
            'ket' => $request->ket,
        ]);
        return response()->json([
            'code' => 200,
            'message' => "Berhasil menambahkan data periode.",
        ]);
    }
    public function updatePeriodeSaldo(Request $request)
    {
        SaldoPeriode::find($request->kode)->update([
            'id_thn' => $request->tahun,
            'bulan' => $request->bulan,
            'saldo_awal' => $request->saldo_awal,
            'sisa_saldo' => $request->sisa_saldo,
            'ket' => $request->ket,
        ]);
        return response()->json([
            'code' => 200,
            'message' => "Berhasil mengubah data periode.",
        ]);
    }
    public function deletePeriodeSaldo(Request $request)
    {
        SaldoPeriode::find($request->kode)->delete();
        return response()->json([
            'code' => 200,
            'message' => "Berhasil menghapus data periode.",
        ]);
    }

    //API TAHUN
    public function getTahun()
    {
        $tahun = Tahun::where([
            'id_user' => auth()->user()->id,
        ])->with('bulan')->orderBy('id_thn', 'desc')->get();

        return response()->json([
            'code' => 200,
            'data' => $tahun,
        ]);
    }
    public function saveTahun(Request $request)
    {
        Tahun::create([
            'id_user' => auth()->user()->id,
            'thn' => $request->tahun,
        ]);
        return response()->json([
            'code' => 200,
            'message' => "Berhasil menambahkan data tahun.",
        ]);
    }
    public function deleteTahun(Request $request)
    {
        Tahun::find($request->kode)->delete();
        return response()->json([
            'code' => 200,
            'message' => "Berhasil menghapus data tahun.",
        ]);
    }

    //API KAS
    public function getDataKas($id=null)
    {
        if ($id==null) return response()->json([
            'saldo' => SaldoPeriode::whereHas('thn', function ($q) {
                        $q->where(['id_user' => auth()->user()->id]);
                    })->where([
                        'id_periode' => request()->periode_id
                    ])->first(),
            'kas' => Kas::where(['id_periode' => request()->periode_id])->get(),
        ]);
        return response()->json(
            Kas::where(['id_kas' => $id])->first()
        );
    }
    public function saveDataKas(LaporanRequest $request)
    {
        $saldo = SaldoPeriode::find($request->bulan)->sisa_saldo;
        if ($request->tipe == 'debit') $saldo += $request->jml_uang;
        else if ($request->tipe == 'kredit') $saldo -= $request->jml_uang;

        SaldoPeriode::find($request->bulan)->update(['sisa_saldo' => $saldo]);
        Kas::create([
            'id_periode' => $request->bulan,
            'tanggal' => $request->tanggal,
            'kebutuhan' => $request->kebutuhan,
            'tipe' => $request->tipe,
            'jml_uang' => $request->jml_uang,
        ]);

        return response()->json([
            'code' => 200,
            'message' => "Berhasil menambahkan data kas.",
        ]);
    }
    public function deleteDataKas(Request $request)
    {
        $pilih_kas = Kas::find($request->kode);
        if ($pilih_kas)
        {
            $kembalikan_saldo = 0;
            $kasp_lama = SaldoPeriode::find($pilih_kas->id_periode);
            if ($pilih_kas->tipe == 'debit')
            {
                $kembalikan_saldo = $kasp_lama->sisa_saldo - $pilih_kas->jml_uang;
                SaldoPeriode::find($pilih_kas->id_periode)->update(['sisa_saldo' => $kembalikan_saldo]);
            }
            else if ($pilih_kas->tipe == 'kredit')
            {
                $kembalikan_saldo = $kasp_lama->sisa_saldo + $pilih_kas->jml_uang;
                SaldoPeriode::find($pilih_kas->id_periode)->update(['sisa_saldo' => $kembalikan_saldo]);
            }
        }
        Kas::find($request->kode)->delete();

        return response()->json([
            'code' => 200,
            'message' => "Berhasil menghapus data kas.",
        ]);
    }
    public function updateDataKas(Request $request)
    {
        $pilih_kas = Kas::find($request->kode);
        if ($pilih_kas)
        {
            $kembalikan_saldo = 0;
            $kasp_lama = SaldoPeriode::find($pilih_kas->id_periode);
            if ($pilih_kas->tipe == 'debit')
            {
                $kembalikan_saldo = $kasp_lama->sisa_saldo - $pilih_kas->jml_uang;
                SaldoPeriode::find($request->bulan)->update([
                    'sisa_saldo' => $kembalikan_saldo + $request->jml_uang,
                ]);
            }
            else if ($pilih_kas->tipe == 'kredit')
            {
                $kembalikan_saldo = $pilih_kas->sisa_saldo + $pilih_kas->jml_uang;
                SaldoPeriode::find($request->bulan)->update([
                    'sisa_saldo' => $kembalikan_saldo - $request->jml_uang,
                ]);
            }
        }

        if ($pilih_kas->tipe != $request->tipe)
        {
            $saldo = SaldoPeriode::find($request->bulan)->sisa_saldo;
            if ($request->tipe == 'debit') $saldo += $request->jml_uang;
            else if ($request->tipe == 'kredit') $saldo -= $request->jml_uang;

            SaldoPeriode::find($request->bulan)->update(['sisa_saldo' => $saldo]);
        }
        Kas::find($request->kode)->update([
            'id_periode' => $request->bulan,
            'tanggal' => $request->tanggal,
            'kebutuhan' => $request->kebutuhan,
            'tipe' => $request->tipe,
            'jml_uang' => $request->jml_uang,
        ]);

        return response()->json([
            'code' => 200,
            'message' => "Berhasil mengubah data kas.",
        ]);
    }
}
