<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        // JIKA ADMIN → LIHAT SEMUA
        if (Auth::user()->role === 'admin') {
            $absensis = Absensi::with('karyawan')
                ->orderBy('tanggal', 'desc')
                ->get();
        }
        // JIKA KARYAWAN → HANYA DATA DIRI SENDIRI
        else {
            $absensis = Absensi::with('karyawan')
                ->where('karyawan_id', Auth::id())
                ->orderBy('tanggal', 'desc')
                ->get();
        }

        return view('absensi.index', compact('absensis'));
    }

    public function masuk()
    {
        $karyawan_id = Auth::id();
        $tanggal = Carbon::today();

        $cek = Absensi::where('karyawan_id', $karyawan_id)
            ->where('tanggal', $tanggal)
            ->first();

        if ($cek) {
            return response()->json(['message' => 'Sudah absen hari ini'], 400);
        }

        Absensi::create([
            'karyawan_id' => $karyawan_id,
            'tanggal' => $tanggal,
            'jam_masuk' => now()->format('H:i:s'),
            'status' => 'Masuk'
        ]);

        return response()->json(['success' => true]);
    }

    public function keluar()
    {
        $karyawan_id = Auth::id();
        $tanggal = Carbon::today();

        $absensi = Absensi::where('karyawan_id', $karyawan_id)
            ->where('tanggal', $tanggal)
            ->first();

        if (!$absensi) {
            return response()->json(['message' => 'Belum absen masuk'], 400);
        }

        if ($absensi->jam_keluar) {
            return response()->json(['message' => 'Sudah absen keluar'], 400);
        }

        $absensi->update([
            'jam_keluar' => now()->format('H:i:s'),
            'status' => 'Selesai'
        ]);

        return response()->json(['success' => true]);
    }
}
