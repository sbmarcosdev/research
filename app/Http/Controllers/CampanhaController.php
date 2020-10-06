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
        session()->put([
            'status_campanha' => 'img/inicio.png',
            'titulo_status' => 'Selecione ou Inclua Nova uma Campanha',
            'link_status' => 'campanhas'
        ]);

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
        
        session()->put([
                    'status_campanha' => 'img/status1.png',
                    'titulo_status' => 'Configure as mensagens da Pesquisa',
                    'link_status' => "url('campanhas')"
                     ]);

        return redirect('/perguntas/' . $insert->id);
    }

    public function edit($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);

        $empresas = Empresa::all();

        session()->put([
            'status_campanha' => 'img/status1.png',
            'titulo_status' => 'Configure as Mensagens da Campanha',
            'link_status' => 'mensagens/'.$campanha_id
        ]);


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

        session()->put([
            'status_campanha' => 'img/status1.png',
            'titulo_status' => 'Configure as mensagens da Pesquisa',
            'link_status' => 'campanhas'
        ]);

        return redirect('/perguntas/' . $campanha->id);
    }


    public function destroy(Request $request)
    {
        $campanha = Campanha::find($request->campanha_id);
        $campanha->delete();
        return redirect('campanhas');
    }
}
