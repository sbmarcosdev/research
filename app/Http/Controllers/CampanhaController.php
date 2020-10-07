<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\Empresa;
use App\Models\Mensagem;
use App\Models\TipoMensagem;
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
            'link_status' => 'campanhas',
            'titulo_fase' => ''
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
                    'link_status' => 'mensagens/'. $insert->id
                     ]);

        $tipoMensagem = TipoMensagem::all();             
        foreach($tipoMensagem as $tipo)
        {
            $mensagens = Mensagem::create([
                'campanha_id' => $insert->id,
                'tipo_mensagem_id' => $tipo->id,
                'texto_mensagem' => '<h2>'.$tipo->tipo.'</h2>'
            ]);             
        } 
        
        return redirect('/mensagens/' . $insert->id);
    }

    public function edit($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);

        $empresas = Empresa::all();

        session()->put([
            'status_campanha' => 'img/status1.png',
            'titulo_status' => 'Configure as Mensagens da Campanha',
            'link_status' => 'mensagens/'.$campanha_id,
            'titulo_fase' => $campanha->descricao,
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
