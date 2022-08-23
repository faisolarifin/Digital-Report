<?php

namespace App\Http\Controllers;

use App\Models\Kas;
use App\Models\SaldoPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function indexDashboard()
    {
        return view('dash.index');
    }

    public function getDataDash()
    {
        $user_id = auth()->user()->id;
        $tahun_id = request()->tahun_id;

        $all_bulan = DB::select("select rsp.bulan, rsp.saldo_awal, rsp.sisa_saldo,
                                        (select sum(jml_uang) from rep_kas where tipe='kredit' and id_periode=rsp.id_periode) kredit,
                                            (select sum(jml_uang) from rep_kas where tipe='debit' and id_periode=rsp.id_periode) debit
                                                from rep_saldo_periode rsp, rep_tahun rt where rsp.id_thn=rt.id_thn and rsp.id_thn='{$tahun_id}'");
        $all_tahun = DB::select("select rt.thn,
                                        (select sum(rk.jml_uang) from rep_kas rk, rep_saldo_periode rsp where rk.tipe='kredit' and rk.id_periode=rsp.id_periode and rsp.id_thn=rt.id_thn group by rk.id_periode) kredit,
                                            (select sum(rk.jml_uang) from rep_kas rk, rep_saldo_periode rsp where rk.tipe='debit' and rk.id_periode=rsp.id_periode and rsp.id_thn=rt.id_thn group by rk.id_periode) debit
                                                from rep_tahun rt where rt.id_user='{$user_id}'");
        return response()->json([
            'grafik' => $all_bulan,
            'tahunan' => $all_tahun,
        ]);
    }

}
