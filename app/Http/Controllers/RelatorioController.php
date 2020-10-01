<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\CampanhaRespondente;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use App\Models\Resposta;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }
    
    public function index()
    {
        $rel = Campanha::all();

        return view('relatorios.index', compact('rel'));
    }

    public function show($campanha_id)
    {
        $sql = "SELECT pergunta_id,
                       (SELECT texto from perguntas where id = pergunta_id) as pergunta,
                       ROUND(sum( peso_resposta ) / (count(id) * 5) * 100)  as peso,
                       count(id) as total 
                  FROM respostas 
                 WHERE campanha_id = $campanha_id 
                 GROUP BY pergunta_id";

        $rel = DB::select($sql);

        $campanha = Campanha::find($campanha_id);

        return view('relatorios.show', compact('rel', 'campanha'));
    }

    public function detalhe($pergunta_id)
    {
        $pergunta = Pergunta::find($pergunta_id);

        if ($pergunta->tipo_id == 5) {

            $respostas = Resposta::where('pergunta_id', $pergunta_id)->get();

            return view('relatorios.descritiva', compact('respostas', 'pergunta'));

        } else {
            $opcoes = OpcaoResposta::where('tipo_id', $pergunta->tipo_id)->get();
            
            foreach ($opcoes as $opcao) {
                $detalhes = Resposta::where('pergunta_id', $pergunta_id)
                    ->where('tipo_id', $pergunta->tipo_id)
                    ->where('peso_resposta', $opcao->peso)
                    ->count();

                $sub[$opcao->peso] = $detalhes;
            }
            return view('relatorios.detalhes', compact('sub', 'opcoes', 'detalhes', 'pergunta'));
        }
    }

    public function respostas($campanha_id, $respondente_id)
    {
        $respondente = CampanhaRespondente::where('respondente_id', $respondente_id)
            ->where('campanha_id', $campanha_id)
            ->get();

        $perguntas = Pergunta::where('campanha_id', $campanha_id)->get();

        $opcoes = OpcaoResposta::where('tipo_id', 1)->get();

        foreach ($perguntas  as $pergunta) {

            $resposta[$pergunta->id] = $pergunta->resposta->where('respondente_id', $respondente_id)
                ->where('campanha_id', $campanha_id)->first();
        }


        return view('relatorios.respostas', compact('respondente', 'opcoes', 'resposta', 'perguntas'));
    }
}
