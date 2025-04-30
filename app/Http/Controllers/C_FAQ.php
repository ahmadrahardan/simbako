<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_FAQ extends Controller
{
    public function faq()
    {
        return view('user.V_FAQ');
    }

    public function adminFaq()
    {
        return view('admin.V_FAQ');
    }
}
