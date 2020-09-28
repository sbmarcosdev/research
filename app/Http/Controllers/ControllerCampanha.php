<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\CampanhaRespondente;
use App\Models\Pergunta;
use App\Models\Resposta;
use Illuminate\Http\Request;

class ControllerCampanha extends Controller
{
    public function __construct()
    {
      //$this->middleware('auth');
    }
    
    public function index()
    {
        $campanhas = Campanha::all();
        return view('campanhas.list', compact('campanhas'));
    }

    public function create()
    {
        return view('campanhas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'descricao' => 'required',
            'data_inicio' => 'required',
            'data_termino' => 'required'
        ]);

        $insert = Campanha::create($validatedData);

        return redirect('/perguntas/'.$insert->id);
    }

    public function edit($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);

        return view('campanhas.frm', compact('campanha'));
    }

    public function update(Request $request, Campanha $campanha)
    {
        $validatedData = $request->validate([
            'descricao' => 'required',
            'data_inicio' => 'required',
            'data_termino' => 'required',
            'status' => 'integer|min:0|max:1'
        ]);

        $update = $campanha->update($validatedData);

        return redirect('/perguntas/'. $campanha->id);
    }


    public function destroy(Request $request)
    {
        $campanha=Campanha::find($request->campanha_id);
        $campanha->delete();
        return redirect('campanhas');
    }
}
