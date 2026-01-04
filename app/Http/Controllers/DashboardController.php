<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Jobdesk;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $hadirHariIni = Absensi::whereDate('tanggal', $today)
            ->whereIn('status', ['Masuk', 'Selesai'])
            ->distinct('karyawan_id')
            ->count('karyawan_id');

        $karyawans = Karyawan::with('jobdesks')->get();

        return view('dashboard.index', [
            // KARYAWAN
            'totalKaryawan' => Karyawan::count(),
            'karyawanAktif' => Karyawan::where('status', 'aktif')->count(),
            'karyawanNonaktif' => Karyawan::where('status', 'nonaktif')->count(),

            // ✅ HADIR
            'hadirHariIni' => $hadirHariIni,

            // JOBDESK
            'karyawanPunyaJobdesk' => Jobdesk::distinct('karyawan_id')->count('karyawan_id'),
            'karyawanTanpaJobdesk' => Karyawan::doesntHave('jobdesks')->count(),

            // DETAIL
            'karyawans' => $karyawans
        ]);
    }
}
