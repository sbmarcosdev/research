<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class SairController extends Controller
{
    public function sair(Request $request)
    {
        $request->session()->forget('login_admin');
        //session()->flush();
        return redirect('login');
    }
}
