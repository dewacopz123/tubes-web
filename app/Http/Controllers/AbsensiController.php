<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Absensi;
use Illuminate\Support\Facades\Log;


class AbsensiController extends Controller
{
    public function index()
    {
        return view('absensi.index'); // pastikan view ini ada
    }
    public function masuk()
    {
        try {
            $user = Auth::user();
            Absensi::create([
                'karyawan_id' => $user->id,
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


    public function keluar()
    {
        $user = Auth::user();

        Absensi::where('karyawan_id', $user->id)
            ->whereDate('tanggal', now())
            ->update([
                'jam_keluar' => now()->toTimeString(),
                'status' => 'Selesai'
            ]);

        return response()->json(['message' => 'Selesai kerja berhasil']);
    }
}
