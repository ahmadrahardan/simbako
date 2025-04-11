<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class C_Profil extends Controller
{
    public function profil()
    {
        return view('master.V_Profil');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $rules = [
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ];

        if (!$user->isAdmin()) {
            $rules = array_merge($rules, [
                'nama' => 'required|string|max:255',
                'telepon' => 'nullable|string|max:20',
                'alamat' => 'nullable|string|max:255',
            ]);
        }

        $messages = [
            'username.required' => 'Username belum terisi!',
            'username.max' => 'Username terlalu panjang!',
            'password.min' => 'Password minimal 8 karakter!',
            'nama.required' => 'Nama belum diisi!',
            'nama.max' => 'Nama terlalu panjang!',
            'telepon.max' => 'Nomor telepon terlalu panjang!',
            'alamat.max' => 'Alamat terlalu panjang!',
        ];

        $validated = $request->validate($rules, $messages);

        $user->username = $validated['username'];

        if (!$user->isAdmin()) {
            $user->nama = $validated['nama'];
            if ($request->filled('telepon')) {
                $user->telepon = $validated['telepon'];
            }

            if ($request->filled('alamat')) {
                $user->alamat = $validated['alamat'];
            }
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
    }
}
