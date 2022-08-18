<?php

namespace App\Http\Middleware;

use App\Models\SaldoPeriode;
use App\Models\Tahun;
use Closure;
use Illuminate\Http\Request;

class Laporan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->tahun_id = request()->segment(2)
                            ?? @Tahun::where([
                                'id_user' => auth()->user()->id,
                                'thn' => Tahun::where('id_user', auth()->user()->id)->max('thn')
                            ])->first()->id_thn;
        $request->periode_id = request()->segment(3)
                            ?? SaldoPeriode::where(['id_thn' => $request->tahun_id])->max('id_periode');
        return $next($request);
    }
}
