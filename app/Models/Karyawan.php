<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Karyawan extends Authenticatable
{
    protected $table = 'karyawans';

    protected $fillable = [
        'kode',
        'nama',
        'email',
        'password',
        'telepon',
        'role',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];
}

