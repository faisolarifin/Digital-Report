<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kas extends Model
{
    use HasFactory;
    protected $table = 'rep_kas';
    protected $primaryKey = 'id_kas';
    protected $fillable = [
        'id_periode',
        'tanggal',
        'kebutuhan',
        'tipe',
        'jml_uang',
    ];
    public function periode()
    {
        return $this->belongsTo(SaldoPeriode::class, 'id_periode');
    }
}
