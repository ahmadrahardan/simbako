<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Jadwal extends Controller
{
    public function jadwal()
    {
        return view('user.V_Jadwal');
    }

    public function adminJadwal()
    {
        return view('admin.V_Jadwal');
    }
}
