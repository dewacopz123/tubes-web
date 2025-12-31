<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenggajianController extends Controller
{
    public function index()
    {
        return view('penggajian.penggajian', [
            'penggajians' => Penggajian::with('karyawan')->get(),
            'karyawans' => Karyawan::all()
        ]);
    }

    public function create()
{
    return view('penggajian.formaddeditpenggajian', [
        'karyawans' => Karyawan::all()
    ]);
}

    public function store(Request $request)
{
    $tanggal = $request->tanggal;

    if (str_contains($tanggal, '/')) {
        $tanggal = Carbon::createFromFormat('d/m/Y', $tanggal)
            ->format('Y-m-d');
    }

    Penggajian::create([
        'kode_penggajian' => 'PG-' . time(),
        'karyawan_id' => $request->karyawan_id,
        'tanggal' => $tanggal,
        'gaji_pokok' => $request->gaji_pokok
    ]);

    return response()->json(['success' => true]);
}

    public function show($id)
    {
        return Penggajian::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $penggajian = Penggajian::findOrFail($id);

        $penggajian->update([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'gaji_pokok' => $request->gaji_pokok
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Penggajian::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
