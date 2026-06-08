<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\ValidatesSekData;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui.',
            ]);
        }

        return redirect()->back()->with('success', 'Profile berhasil diperbarui');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $karyawan = Auth::user();

        $upload = Cloudinary::upload(
            $request->file('foto')->getRealPath(),
            [
                'folder' => 'sek/profile'
            ]
        );

        $fotoUrl = $upload->getSecurePath();

        $karyawan->update([
            'foto' => $fotoUrl
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Foto berhasil diupload',
            'foto_url' => $fotoUrl
        ]);
    }
}
