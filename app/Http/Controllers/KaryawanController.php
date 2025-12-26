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

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans',
            'telepon' => 'required',
            'role' => 'required',
            'status' => 'required'
        ]);

        Karyawan::create($request->all());

        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        return response()->json(
            Karyawan::findOrFail($id)
        );
    }


    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $karyawan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'role' => $request->role,
            'status' => $request->status
        ]);

        return response()->json(['success' => true]);
    }


    public function destroy($id)
    {
        Karyawan::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
}
