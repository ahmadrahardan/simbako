<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class C_Register extends Controller
{
    public function daftar() {
        return view("auth.V_Register");
    }

    public function daftarUser(Request $request)
    {
        $validatedRegister = $request->validate([
            'nama' => 'required',
            'email'=> 'required|email|unique:users,email',
            'telepon' => 'required|min:12',
            'kbli'=> 'required',
            'siinas'=> 'required',
            'alamat'=> 'required',
        ]);
        User::create($validatedRegister);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Silakan login.');
    }
}
