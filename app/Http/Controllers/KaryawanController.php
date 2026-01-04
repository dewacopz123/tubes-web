<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'nama'   => 'required|string',
            'email'  => 'required|email|unique:karyawans,email',
            'role'   => 'required|in:admin,karyawan',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        // AUTO kode karyawan (AMAN & UNIQUE)
        $validated['kode_karyawan'] = 'KRY-' . strtoupper(Str::random(6));

        // DEFAULT PASSWORD (SUDAH BCRYPT)
        $validated['password'] = Hash::make('123456');

        $karyawan = Karyawan::create($validated);

        return response()->json([
            'success' => true,
            'id' => $karyawan->id
        ]);
    }

    public function show($id)
    {
        return response()->json(Karyawan::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $validated = $request->validate([
            'nama'   => 'required|string',
            'email'  => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'role'   => 'required|in:admin,karyawan',
            'status' => 'required|in:Aktif,Nonaktif',
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
