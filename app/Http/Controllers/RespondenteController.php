<?php

namespace App\Http\Controllers;

use App\Models\Respondente;
use Illuminate\Http\Request;

class RespondenteController extends Controller
{
     public function index()
    {
        //$pes = Respondente::all();
        //return view('importar.list');
    }

    public function create()
    {
        return view('importar.frm');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Respondente $respondente)
    {
        $pes = Respondente::all();
        $pes->campanha();
        
        return view('importar.list');
    }

    public function edit(Respondente $respondente)
    {
        //
    }

    public function update(Request $request, Respondente $respondente)
    {
        //
    }

    public function destroy(Respondente $respondente)
    {
       //
    }
}
