<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $request->validate([
            'kode_karyawan' => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'kode_karyawan' => $request->kode_karyawan,
            'password' => $request->password,
            'status' => 'Aktif'
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'kode_karyawan' => 'ID Karyawan atau Password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}

