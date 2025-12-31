<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Support\Carbon;
use App\Models\Jobdesk;

class DashboardController extends Controller
{
    public function index()
    {
       $today = Carbon::today();

    $karyawans = Karyawan::with('jobdesks')->get();

    return view('dashboard.index', [
        // KARYAWAN
        'totalKaryawan' => Karyawan::count(),
        'karyawanAktif' => Karyawan::where('status', 'aktif')->count(),
        'karyawanNonaktif' => Karyawan::where('status', 'nonaktif')->count(),

        // ABSENSI
        'hadirHariIni' => Absensi::whereDate('tanggal', $today)
                                ->where('status', 'Hadir')->count(),

        // JOBDESK (ASLI)
        'karyawanPunyaJobdesk' => Jobdesk::distinct('karyawan_id')->count('karyawan_id'),
        'karyawanTanpaJobdesk' => Karyawan::doesntHave('jobdesks')->count(),

        // DETAIL
        'karyawans' => $karyawans
    ]);
    }
}
