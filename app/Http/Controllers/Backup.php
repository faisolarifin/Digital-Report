<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\SaldoPeriode;
use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Backup extends Controller
{
    public function indexExport()
    {
        return view('backup.export');
    }
    public function exportDb()
    {
        $data = array();
        foreach (Tahun::all() as $tahun) {
            $temp = array();
            foreach (SaldoPeriode::where('id_thn', '=', $tahun->id_thn)->get() as $periode) {
                array_push($temp, [
                    'bulan' => $periode->bulan,
                    'saldo_awal' => $periode->saldo_awal,
                    'sisa_saldo' => $periode->sisa_saldo,
                    'keterangan' => $periode->ket,
                    'kas' => Kas::select([
                        'tanggal', 'kebutuhan', 'tipe', 'jml_uang'
                    ])->where('id_periode', '=', $periode->id_periode)->get(),
                ]);
            }
            array_push($data, [
                'tahun' => $tahun->thn,
                'periode' => $temp,
            ]);
        }
        $now = Carbon::now();
        $filename = "DBbackup - $now.json";
        return response()->make($data, 200, [
            'Content-type' => 'text/json',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }
    public function indexImport()
    {
        return view('backup.import');
    }
    public function importDb(Request $request)
    {
        $this->validate($request,[
            'database' => 'required|mimes:json',
        ]);

        $db = json_decode(file_get_contents($request->file('database')));
        DB::transaction(function () use ($db) {
            Tahun::where([
                'id_user' => auth()->user()->id,
            ])->delete();
            foreach ($db as $tahun) {
                $thn = Tahun::create([
                    'id_user' => auth()->user()->id,
                    'thn' => $tahun->tahun,
                ]);
                foreach ($tahun->periode as $periode) {
                    $prd = SaldoPeriode::create([
                        'id_thn' => $thn->id_thn,
                        'bulan' => $periode->bulan,
                        'saldo_awal' => $periode->saldo_awal,
                        'sisa_saldo' => $periode->sisa_saldo,
                        'ket' => $periode->keterangan,
                    ]);
                    foreach ($periode->kas as $kas) {
                        Kas::create([
                            'id_periode' => $prd->id_periode,
                            'tanggal' => $kas->tanggal,
                            'kebutuhan' => $kas->kebutuhan,
                            'tipe' => $kas->tipe,
                            'jml_uang' => $kas->jml_uang,
                        ]);
                    }
                }
            }
        });
        return redirect()
            ->route('rep.kas')
            ->with('success', 'berhasil melakukan import database');
    }
}
