<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class C_Login extends Controller
{
    public function masuk()
    {
        return view('auth.V_login');
    }

    public function cekData(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:8',
        ], [
            'username.required' => 'Username belum terisi!',
            'password.required' => 'Password belum terisi!',
            'password.min' => 'Password minimal 8 karakter!',
        ]);

        $infoLogin = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if (Auth::attempt($infoLogin)) {
            $request->session()->regenerate();

            return redirect()->route('V_Dashboard');
        }

        return redirect('/login')->with('failed', 'Username atau Password Salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('landing');
    }
}
