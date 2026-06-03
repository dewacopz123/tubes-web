<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Jobdesk;
use App\Models\Absensi;
use App\Models\Penggajian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SyncController extends Controller
{
    public function karyawans()
    {
        return Karyawan::select(['id', 'kode_karyawan', 'nama', 'email', 'telepon', 'role', 'status', 'created_at', 'updated_at'])->get();
    }

    public function jobdesks()
    {
        return Jobdesk::with('karyawan:id,nama')->orderBy('id', 'desc')->get();
    }

    public function absensis()
    {
        return Absensi::with('karyawan:id,nama')->orderBy('tanggal', 'desc')->get();
    }

    public function penggajians()
    {
        return Penggajian::with('karyawan:id,nama')->orderBy('tanggal', 'desc')->get();
    }

    public function absensiMasuk(Request $request)
    {
        $karyawanId = Auth::id();
        $tanggal = Carbon::today();

        $exists = Absensi::where('karyawan_id', $karyawanId)
            ->where('tanggal', $tanggal)
            ->first();

        if ($exists) {
            return response()->json(['message' => 'Sudah absen hari ini'], 400);
        }

        $absensi = Absensi::create([
            'karyawan_id' => $karyawanId,
            'tanggal' => $tanggal,
            'jam_masuk' => now()->format('H:i:s'),
            'status' => 'Masuk',
        ]);

        return response()->json(['success' => true, 'data' => $absensi]);
    }

    public function absensiKeluar(Request $request)
    {
        $karyawanId = Auth::id();
        $tanggal = Carbon::today();

        $absensi = Absensi::where('karyawan_id', $karyawanId)
            ->where('tanggal', $tanggal)
            ->first();

        if (! $absensi) {
            return response()->json(['message' => 'Belum absen masuk'], 400);
        }

        if ($absensi->jam_keluar) {
            return response()->json(['message' => 'Sudah absen keluar'], 400);
        }

        $absensi->update([
            'jam_keluar' => now()->format('H:i:s'),
            'status' => 'Selesai',
        ]);

        return response()->json(['success' => true, 'data' => $absensi]);
    }

    public function storeJobdesk(Request $request)
    {
        $request->validate([
            'nama_jobdesk' => 'required|string',
            'tugas_utama' => 'required|string',
            'karyawan_id' => 'required|exists:karyawans,id',
        ]);

        $jobdesk = Jobdesk::create($request->only(['nama_jobdesk', 'tugas_utama', 'karyawan_id']));

        return response()->json(['success' => true, 'data' => $jobdesk]);
    }

    public function updateJobdesk(Request $request, $id)
    {
        $request->validate([
            'nama_jobdesk' => 'required|string',
            'tugas_utama' => 'required|string',
            'karyawan_id' => 'required|exists:karyawans,id',
        ]);

        $jobdesk = Jobdesk::findOrFail($id);
        $jobdesk->update($request->only(['nama_jobdesk', 'tugas_utama', 'karyawan_id']));

        return response()->json(['success' => true, 'data' => $jobdesk]);
    }

    public function destroyJobdesk($id)
    {
        Jobdesk::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function storePenggajian(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'gaji_pokok' => 'required|numeric',
        ]);

        $tanggal = $request->tanggal;
        if (str_contains($tanggal, '/')) {
            $tanggal = Carbon::createFromFormat('d/m/Y', $tanggal)->format('Y-m-d');
        }

        $penggajian = Penggajian::create([
            'kode_penggajian' => 'PG-' . time(),
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $tanggal,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        return response()->json(['success' => true, 'data' => $penggajian]);
    }

    public function updatePenggajian(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'gaji_pokok' => 'required|numeric',
        ]);

        $penggajian = Penggajian::findOrFail($id);
        $penggajian->update([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'gaji_pokok' => $request->gaji_pokok,
        ]);

        return response()->json(['success' => true, 'data' => $penggajian]);
    }

    public function destroyPenggajian($id)
    {
        Penggajian::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
