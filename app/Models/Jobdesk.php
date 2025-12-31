<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobdesk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jobdesk',
        'tugas_utama',
        'karyawan_id'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}

