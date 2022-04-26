<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeDetail extends Model
{
    protected $table = 'detail_pemasukan';
    protected $guarded = ['id'];
    public $timestamps = false;


    use HasFactory;
}
