<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'kecamatan';
    protected $guarded = ['id'];
    public $timestamps = false;

    use HasFactory;
}
