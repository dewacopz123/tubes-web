<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    // redirect ke Google
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    // callback dari Google
    public function callback()
{
    /** @var \Laravel\Socialite\Two\AbstractProvider $provider */
    $provider = Socialite::driver('google');

    $googleUser = $provider->stateless()->user();

    $user = User::where('email', $googleUser->getEmail())->first();

    if (!$user) {
        $user = User::create([
            'name' => $googleUser->getName(),
            'email' => $googleUser->getEmail(),
            'password' => bcrypt(Str::random(16)),
        ]);
    }

    Auth::login($user);

    return redirect()->route('login.index');
}

public function login(Request $request)
{
    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();
        return redirect('/karyawan');
    }

    return back();
}



}
