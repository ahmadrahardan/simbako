<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edukasi;

class C_Edukasi extends Controller
{
    public function edukasi()
    {
        $data = Edukasi::latest()->get();
        return view('user.V_Edukasi', compact('data'));
    }

    public function adminEdukasi()
    {
        $data = Edukasi::latest()->get();
        return view('admin.V_Edukasi', compact('data'));
    }

    public function konten($slug)
    {
        $edukasi = Edukasi::where('slug', $slug)->firstOrFail();
        return view('master.V_KontenEdukasi', compact('edukasi'));
    }
}
