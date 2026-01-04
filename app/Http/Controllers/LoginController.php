<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Karyawan;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 'Aktif'
            ])
        ) {
            $request->session()->regenerate();

            return Auth::user()->role === 'admin'
                ? redirect('/dashboard')
                : redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

     public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:karyawans,email',
            'password' => 'required|min:6',
        ]);

        $karyawan = Karyawan::create([
            'kode_karyawan' => 'KRY-' . strtoupper(Str::random(6)),
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), // 🔐 BCRYPT
            'role' => 'karyawan',                          // AUTO
            'status' => 'Aktif',
        ]);

        // AUTO LOGIN setelah register
        Auth::login($karyawan);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

