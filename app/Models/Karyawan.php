<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Authenticatable
{
    use HasFactory;

    protected $table = 'karyawans';

    protected $fillable = [
        'nama',
        'email',
        'telepon', // ✅ tambahkan telepon
        'role',
        'status',
        'password' // harus ada karena kita buat default
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
