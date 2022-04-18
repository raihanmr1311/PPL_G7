<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'pengeluaran';

    public function details()
    {
        return $this->hasMany(ExpenseDetail::class, 'id_pengeluaran');
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_karyawan');
    }
}
