<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Jadwal;

class C_Jadwal extends Controller
{
    public function jadwal()
    {
        $data = Jadwal::latest()->get();
        return view('user.V_Jadwal', compact('data'));
    }

    public function adminJadwal()
    {
        $data = Jadwal::latest()->get();
        return view('admin.V_Jadwal', compact('data'));
    }
}
