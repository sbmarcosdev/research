<?php

namespace App\Http\Controllers;

use App\Models\OpcaoPergunta;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpcoesController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }
    
    public function create($pergunta_id)
    {
        $pergunta = Pergunta::find($pergunta_id);

        $op = [];

        foreach($pergunta->opcoes as $opcao)
        {
           array_push($op, $opcao->opcao_resposta_id);
        }

        $opcaoResposta = OpcaoResposta::query()->select('ordem')
            ->whereIn('id', $op)
            ->orderBy('ordem','DESC')
            ->first();

         if ($opcaoResposta)
            $maxValue = 1 + $opcaoResposta->ordem;
         else
            $maxValue = 1;
            
        return view('opcoes.create',compact('pergunta','maxValue'));
    }

    public function show($pergunta_id)
    {
        $opcoes = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                                ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                                ->where('perguntas.id', $pergunta_id)
                                ->get();

        $pergunta = Pergunta::find($pergunta_id);

        return view('opcoes.list', compact('pergunta','opcoes'));
    }

    public function edit($opcao_id)
    {
        $opcao = OpcaoResposta::find($opcao_id);
        $opcaoPergunta = OpcaoPergunta::where('opcao_resposta_id',$opcao->id)->get();
        $pergunta = $opcaoPergunta->first()->pergunta;
        return view('opcoes.frm', compact('pergunta', 'opcao'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tipo_id' => 'required|int',
            'peso' => 'required|int',
            'ordem' => 'required|int',
            'titulo' => 'required'
        ]);

        $opcaoResposta = OpcaoResposta::find($id);
        
        $opcaoResposta->update($validatedData);        

        $opcoes = OpcaoPergunta::where('pergunta_id', $request->pergunta_id)->get();

        $pergunta = $opcoes->first()->pergunta;

        return view('opcoes.list', compact('opcoes', 'pergunta'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_id' => 'required|int',
            'peso' => 'required|int',
            'ordem' => 'required|int',
            'titulo' => 'required'
        ]);

        $opcaoResposta = OpcaoResposta::create($validatedData);

        $ins = OpcaoPergunta::create([
            'pergunta_id' => $request->pergunta_id,
            'opcao_resposta_id' => $opcaoResposta->id
            ]);
        
        $opcoes = OpcaoPergunta::where('pergunta_id', $request->pergunta_id)->get();

        $pergunta = $opcoes->first()->pergunta;

        return view('opcoes.list', compact('opcoes','pergunta'));    
    }

    public function destroy(Request $request)
    {
        $opcao = OpcaoPergunta::find($request->opcao_pergunta_id);
        
        $opcao->delete();

        $opcaoResp = OpcaoResposta::find($request->opcao_resposta_id);

        $opcaoResp->delete();

        $opcoes = OpcaoPergunta::where('pergunta_id', $request->pergunta_id)->get();

        $pergunta = Pergunta::find($request->pergunta_id);

        return view('opcoes.list', compact('opcoes', 'pergunta'));  
    }
}
