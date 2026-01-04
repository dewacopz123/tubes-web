<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobdesk;
use App\Models\Karyawan;

class JobdeskController extends Controller
{
    // Tampilkan semua jobdesk
    public function index()
    {
        $jobdesks = Jobdesk::with('karyawan')->get();
        $karyawans = Karyawan::all(); // untuk select dropdown

        return view('Jobdesk.index', compact('jobdesks', 'karyawans'));
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'nama_jobdesk' => 'required|string',
            'tugas_utama' => 'required|string',
            'karyawan_id' => 'required|exists:karyawans,id'
        ]);

        Jobdesk::create($request->all()); // kode otomatis dibuat oleh model

        return response()->json(['message' => 'Jobdesk berhasil ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jobdesk' => 'required|string',
            'tugas_utama' => 'required|string',
            'karyawan_id' => 'required|exists:karyawans,id'
        ]);

        $jobdesk = Jobdesk::findOrFail($id);
        $jobdesk->update($request->all());

        return response()->json(['message' => 'Jobdesk berhasil diupdate']);
    }

    public function show($id)
    {
        return Jobdesk::findOrFail($id);
    }


    // Hapus jobdesk
    public function destroy($id)
    {
        Jobdesk::findOrFail($id)->delete();
        return response()->json(['message' => 'Jobdesk berhasil dihapus']);
    }


    public function form()
    {
        $karyawans = Karyawan::all();
        return view('jobdesk.formAddEdit', compact('karyawans'));
    }

}
