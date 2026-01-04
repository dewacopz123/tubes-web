<?php
namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        return view('karyawan.index', compact('karyawans'));
    }

    // 🔥 TAMBAHKAN INI
    public function form()
    {
        return view('karyawan.form');
    }

    public function show($id)
    {
        return response()->json(
            Karyawan::findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email',
            'telepon' => 'nullable',
            'role' => 'required|in:admin,karyawan',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        // 🔥 WAJIB ADA
        $data['kode_karyawan'] = 'KRY-' . strtoupper(Str::random(6));
        $data['password'] = Hash::make('123456');

        Karyawan::create($data);

        return response()->json(['success' => true]);
    }


    public function update(Request $request, $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $id,
            'telepon' => 'nullable',
            'role' => 'required|in:admin,karyawan',
            'status' => 'required|in:Aktif,Nonaktif',
        ]);

        $karyawan->update($data);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Karyawan::destroy($id);
        return response()->json(['success' => true]);
    }
}
