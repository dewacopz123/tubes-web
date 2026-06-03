<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ValidatesSekData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Karyawan;

class ProfileController extends Controller
{
    use ValidatesSekData;

    public function index()
    {
        $karyawan = Karyawan::findOrFail(Auth::id());

        return view('Profiles.profile', compact('karyawan'));
    }

    public function update(Request $request)
    {
        $karyawan = Karyawan::findOrFail(Auth::id());

        $data = $request->validate(
            $this->profileRules((int) $karyawan->id),
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $karyawan->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'telepon' => $data['telepon'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }
}
