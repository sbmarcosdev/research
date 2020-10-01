<?php

namespace App\Http\Controllers;

use App\Models\Respondente;
use Illuminate\Http\Request;

class RespondenteController extends Controller
{
    
    public function create()
    {
        return view('importar.frm');
    }

   
    public function show(Respondente $respondente)
    {
        $pes = Respondente::all();
        $pes->campanha();
        
        return view('importar.list');
    }

}
