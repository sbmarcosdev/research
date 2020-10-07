<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
    public function create($campanha_id)
    {
       return view('mensagens.create', compact('campanha_id'));
    }


    public function store(Request $request)
    {
        Mensagem::create([
            'campanha_id' => $request->campanha_id,
            'tipo_mensagem_id' => $request->tipo_mensagem_id,
            'texto_mensagem' => $request->texto_mensagem
        ]);

        session()->put([
            'status_campanha' => 'img/status2.png',
            'titulo_status' => 'Cadastre as Perguntas da Pesquisa'
            
        ]);
        
        return redirect('mensagens/' . $request->campanha_id);
    }
    
   
    public function show($campanha_id)
    {
        $mensagens = Mensagem::where('campanha_id', $campanha_id)->get();

        return view('mensagens.list', compact('mensagens','campanha_id'));
    }

    
    public function edit($id)
    {
        $mensagem = Mensagem::find($id);
        
        return view('mensagens.frm', compact('mensagem'));
    }

    
    public function update(Request $request, $id)
    {
        $mensagem = Mensagem::find($id);

        $mensagem->update(['texto_mensagem' => $request->texto_mensagem]);

        session()->put(['status_campanha' => 'img/status2.png',
                        'titulo_status' => 'Cadastre as Perguntas da Pesquisa']);

        return redirect('mensagens/'. $request->campanha_id);
    }

    public function destroy($id)
    {
        $mensagem = Mensagem::find($id);
        $mensagem->delete();
        return redirect()->back();
    }
}
