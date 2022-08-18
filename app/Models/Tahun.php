<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tahun extends Model
{
    use HasFactory;
    protected $table = 'rep_tahun';
    protected $primaryKey = 'id_thn';
    protected $fillable = ['id_user', 'thn'];
    protected $hidden = ['created_at', 'updated_at'];

    public function bulan()
    {
        return $this->hasMany(SaldoPeriode::class, 'id_thn', 'id_thn');
    }

}
