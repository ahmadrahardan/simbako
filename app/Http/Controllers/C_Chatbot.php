<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Chatbot extends Controller
{
    public function chatbot()
    {
        return view('user.V_Chatbot');
    }
}
