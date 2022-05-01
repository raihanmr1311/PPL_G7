<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Income extends Model
{
    protected $table = 'pemasukan';
    protected $guarded = ['id'];
    protected $appends = ['total_harga'];

    use HasFactory;

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_karyawan');
    }

    public function details()
    {
        return $this->hasMany(IncomeDetail::class, 'id_pemasukan');
    }

    public function getTotalHargaAttribute()
    {
        return $this->details()->sum(DB::raw('detail_pemasukan.harga * detail_pemasukan.kuantitas'));
    }
}
