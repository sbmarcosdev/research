<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;

class MensagemController extends Controller
{

    public function __construct()
    {
        $this->middleware('ad_checked');
    }

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
            'step' => 2,
            'status_campanha' => 'img/status2.png',
            'titulo_status' => 'Cadastre as Perguntas da Pesquisa',
            'link_status' => 'perguntas/' . $request->campanha_id
        ]);

        return redirect('mensagens/' . $request->campanha_id);
    }


    public function show($campanha_id)
    {
        $mensagens = Mensagem::where('campanha_id', $campanha_id)->get();

        return view('mensagens.list', compact('mensagens', 'campanha_id'));
    }


    public function edit($id)
    {
        $mensagem = Mensagem::find($id);

        return view('mensagens.frm', compact('mensagem'));
    }


    public function update(Request $request, $id)
    {
        $mensagem = Mensagem::find($id);

        $mensagem->update([

            'texto_mensagem' => $request->texto_mensagem,
            'opcao_sim' => isset($request->opcao_sim) ? 'checked' : false,
            'titulo_opcao_sim' => $request->titulo_opcao_sim,
            'opcao_nao' => isset($request->opcao_nao) ? 'checked' : false,
            'titulo_opcao_nao' => $request->titulo_opcao_nao,
        ]);

        session()->put([
            'step' => 2,
            'status_campanha' => 'img/status2.png',
            'titulo_status' => 'Cadastre as Perguntas da Pesquisa',
            'link_status' => 'perguntas/' . $request->campanha_id
        ]);

        return redirect('mensagens/' . $request->campanha_id);
    }

    public function destroy($id)
    {
        $mensagem = Mensagem::find($id);
        $mensagem->delete();
        return redirect()->back();
    }
}
