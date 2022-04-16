<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'barang';
    protected $guarded = ['id'];
    public $timestamps = false;

    use HasFactory;
}
