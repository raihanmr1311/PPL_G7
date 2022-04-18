<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'detail_pengeluaran';
    public $timestamps = false;

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'id_pengeluaran');
    }
}
