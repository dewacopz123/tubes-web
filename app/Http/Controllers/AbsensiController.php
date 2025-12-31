<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Log;

class AbsensiController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        $absensis = Absensi::with('karyawan')->orderBy('tanggal', 'desc')->get();
        return view('absensi.index', compact('karyawans', 'absensis'));
    }

    public function masuk(Request $request)
    {
        try {
            $karyawan_id = $request->karyawan_id; // bisa admin pilih siapa
            Absensi::create([
                'karyawan_id' => $karyawan_id,
                'tanggal' => now()->toDateString(),
                'jam_masuk' => now()->toTimeString(),
                'status' => 'Masuk'
            ]);

            return response()->json(['message' => 'Masuk kerja berhasil']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data'], 500);
        }
    }

    public function keluar(Request $request)
    {
        try {
            $karyawan_id = $request->karyawan_id;
            Absensi::where('karyawan_id', $karyawan_id)
                ->whereDate('tanggal', now())
                ->update([
                    'jam_keluar' => now()->toTimeString(),
                    'status' => 'Selesai'
                ]);

            return response()->json(['message' => 'Selesai kerja berhasil']);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data'], 500);
        }
    }
}
