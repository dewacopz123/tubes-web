<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'kode_karyawan',
        'nama',
        'email',
        'password',
        'role',
        'status'
    ];

    protected $hidden = ['password'];


    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    public function jobdesks()
    {
        return $this->hasMany(Jobdesk::class);
    }

    public function penggajians()
    {
        return $this->hasMany(Penggajian::class);
    }

}

