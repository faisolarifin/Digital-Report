<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoPeriode extends Model
{
    use HasFactory;
    protected $table = 'rep_saldo_periode';
    protected $primaryKey = 'id_periode';
    protected $fillable = [
        'id_thn',
        'bulan',
        'saldo_awal',
        'sisa_saldo',
        'ket',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function thn()
    {
        return $this->belongsTo(Tahun::class, 'id_thn');
    }
}
