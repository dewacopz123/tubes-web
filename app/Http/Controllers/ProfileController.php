<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class ProfileController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::findOrFail(Auth::id());

        return view('profiles.profile', compact('karyawan'));
    }

    public function update(Request $request)
    {
        $karyawan = Karyawan::findOrFail(Auth::id());

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email',
            'telepon' => 'nullable|string|max:20',
        ]);

        $karyawan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
        ]);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }
}
