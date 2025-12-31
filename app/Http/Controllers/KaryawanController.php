<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email',
            'telepon' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        // Tambahkan default password
        $validated['password'] = bcrypt('123456');

        // Simpan ke database
        $karyawan = Karyawan::create($validated);

        return response()->json(['success' => true, 'id' => $karyawan->id]);
    }


    public function show($id)
    {
        return response()->json(Karyawan::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'telepon' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        $karyawan->update($validated);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Karyawan::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
