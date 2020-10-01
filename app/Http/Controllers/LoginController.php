<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }
    
    public function index()
    {
        $logins = Login::all();
        return view('login.list', compact('logins'));
    }


    public function create()
    {
        return view('login.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|email|max:191'
        ]);

        $insert = Login::updateOrCreate($validatedData);

        $logins = Login::all();
        return view('login.list', compact('logins'));
    }

    public function destroy(Request $request)
    {
        $login = Login::find($request->id);
        $login->delete();

        $logins = Login::all();
        return view('login.list', compact('logins'));
    }
}
