<?php

namespace App\Exports;

use App\Helpers\Date;
use App\Models\Kas;
use App\Models\SaldoPeriode;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromArray, WithHeadings
{
    public function __construct($periode_id)
    {
        $this->periode_id = $periode_id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array() : array
    {
        $data = [];
        $awal = SaldoPeriode::find($this->periode_id);
        $saldo = $awal->saldo_awal;
        array_push($data, [
            'tanggal' => '-',
            'kebutuhan' => $awal->ket,
            'debit' => number_format($awal->saldo_awal, 2),
            'kredit' => '-',
            'saldo' => number_format($awal->saldo_awal, 2),
        ]);

        foreach (Kas::where('id_periode', $this->periode_id)->get() as $row) {

            if ($row->tipe == 'debit') {
                $saldo += $row->jml_uang;
                $kredit = '-';
                $debit = (int) $row->jml_uang;
            }
            else if ($row->tipe == 'kredit') {
                $saldo -= $row->jml_uang;
                $kredit = (int) $row->jml_uang;
                $debit = '-';
            }
            array_push($data, [
                'tanggal' => Date::tglReverse($row->tanggal),
                'kebutuhan' => $row->kebutuhan,
                'debit' => (is_int($debit)) ? number_format($debit, 2) : $debit,
                'kredit' => (is_int($kredit)) ? number_format($kredit, 2) : $kredit,
                'saldo' => number_format($saldo, 2),
            ]);
        }

        return $data;
    }
    public function headings(): array
    {
        return [
            'Tanggal',
            'Keterangan',
            'Debit',
            'Kredit',
            'Saldo',
        ];
    }


}
