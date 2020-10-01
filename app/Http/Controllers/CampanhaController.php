<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\Empresa;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }

    public function index()
    {      
        $campanhas = Campanha::all();
        return view('campanhas.list', compact('campanhas'));
    }

    public function create()
    {   
        $empresas = Empresa::all();
        return view('campanhas.create', compact('empresas'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required',
            'data_inicio' => 'required',
            'data_termino' => 'required',
            'empresa_id' => 'required'
        ]);

        $insert = Campanha::create($validatedData);

        return redirect('/perguntas/' . $insert->id);
    }

    public function edit($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);

        $empresas = Empresa::all();

        return view('campanhas.frm', compact('campanha','empresas'));
    }

    public function update(Request $request, Campanha $campanha)
    {
        $validatedData = $request->validate([
            'descricao' => 'required',
            'data_inicio' => 'required',
            'data_termino' => 'required',
            'status' => 'integer|min:0|max:1',
            'empresa_id' => 'required'
        ]);

        $update = $campanha->update($validatedData);

        return redirect('/perguntas/' . $campanha->id);
    }


    public function destroy(Request $request)
    {
        $campanha = Campanha::find($request->campanha_id);
        $campanha->delete();
        return redirect('campanhas');
    }
}
