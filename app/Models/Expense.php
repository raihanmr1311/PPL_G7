<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pengeluaran';
    protected $appends = ['total_harga'];

    public function details()
    {
        return $this->hasMany(ExpenseDetail::class, 'id_pengeluaran');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_karyawan');
    }

    public function getTotalHargaAttribute()
    {

        return $this->details()->sum(DB::raw('detail_pengeluaran.harga * detail_pengeluaran.kuantitas'));
    }
}
