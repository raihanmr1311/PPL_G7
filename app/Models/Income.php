<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'pemasukan';
    protected $guarded = ['id'];

    use HasFactory;

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_karyawan');
    }

    public function details()
    {
        return $this->hasMany(IncomeDetail::class, 'id_pemasukan');
    }
}
