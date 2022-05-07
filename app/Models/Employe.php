<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employe extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'karyawan';

    public function district()
    {
        return $this->belongsTo(District::class, 'id_kecamatan');
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class, 'id_karyawan');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
