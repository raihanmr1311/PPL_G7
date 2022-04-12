<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employe extends Authenticatable
{
    protected $guarded = ['id'];
    protected $table = 'karyawan';


    use SoftDeletes;
    use HasFactory;
}
