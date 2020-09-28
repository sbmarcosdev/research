<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\CampanhaRespondente;
use App\Models\OpcaoPergunta;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use App\Models\Resposta;
use App\Models\RespostaOpcao;
use App\Models\StatusRespondente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RespostaController extends Controller
{

    public function login(Request $request, $campanha_id, $respondente_id)
    {
        $varSessao = [];
        $varSessao['campanha_id'] = $campanha_id;
        $varSessao['respondente_id'] = $respondente_id;

        if ($resp = CampanhaRespondente::where('respondente_id', $respondente_id)
            ->where('campanha_id', $campanha_id)
            ->first()
        ) {
            if (($resp->campanha->data_inicio <= date('Y-m-d'))
                && ($resp->campanha->data_termino >= date('Y-m-d'))
            ) {
                $request->session()->put(['login_respondente' => $varSessao]);
                return redirect('resposta');
            } else {
                $request->session()->flush();
                $erro = ['erro' => 'Campanha Encerrada'];
                return view('respostas.erro', compact('resp', 'erro'));
            }
        } else {
            $request->session()->flush();
            $erro = ['erro' => 'Dados Não Localizados para esta Campanha'];
            return view('respostas.erro', compact('erro'));
        }
    }

    public function edit(Request $request)
    {
        $session = $request->session()->get('login_respondente');
        $respondente_id = $session['respondente_id'];
        $campanha_id = $session['campanha_id'];

        $sql = "SELECT pergunta_id FROM perguntas P 
                        INNER JOIN status_respondentes S
                                ON P.id = S.pergunta_id
                        INNER JOIN campanha_respondentes CR
                                ON S.campanha_respondente_id = CR.id
                              where CR.campanha_id= $campanha_id 
                                and CR.respondente_id = '$respondente_id'
                                and S.respondida = 'N'
                           order by P.ordem";

        $preguntasOrdenadas = DB::select($sql);

        $resp = CampanhaRespondente::where('respondente_id', $respondente_id)
            ->where('campanha_id', $campanha_id)
            ->first();

        $resta = count($resp->status->where('respondida', 'N'));
        $total = count($resp->status);
        $respondidas = 1 + count($resp->status->where('respondida', 'S'));
        $resp->qtd = $respondidas . "/" . $total;
        $resp->progresso =  $respondidas / $total * 100;

        if (!$resta) {
            $request->session()->flush();
            $msg = ['msg' => 'Avaliação Registrada com Sucesso. Muito obrigado por participar! '];
            return view('respostas.msg', compact('msg'));
        } else {

            foreach ($preguntasOrdenadas as $listaPergunta) {

                $pergunta = Pergunta::find($listaPergunta->pergunta_id);

                if ($pergunta->tipo_id == 1) {
                    $opcoes = OpcaoResposta::where('tipo_id', 1)->get();
                    return view('respostas.classificatoria', compact('resp', 'pergunta', 'opcoes'));
                } elseif ($pergunta->tipo_id == 2) {
                    $opcoesNum = OpcaoResposta::where('tipo_id', 2)->get();
                    return view('respostas.listNum', compact('resp', 'pergunta', 'opcoesNum'));
                } elseif ($pergunta->tipo_id == 3) {
                    $afirmativa = OpcaoResposta::where('tipo_id', 3)->get();
                    return view('respostas.afirmativa', compact('resp', 'pergunta', 'afirmativa'));

                } elseif ($pergunta->tipo_id == 4) {

                    $multipla = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                        ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                        ->where('perguntas.id', $pergunta->id)
                        ->where('opcao_respostas.tipo_id',4)->get();
                        

                    return view('respostas.multipla', compact('resp', 'pergunta', 'multipla'));
                } elseif ($pergunta->tipo_id == 5) {
                    return view('respostas.descritiva', compact('resp', 'pergunta'));
                } elseif ($pergunta->tipo_id == 6) {
                    
                    $opcoes = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                        ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                        ->where('perguntas.id', $pergunta->id)
                        ->where('opcao_respostas.tipo_id', 6)->get();

                    return view('respostas.personalizada', compact('resp', 'pergunta', 'opcoes'));
                }
            }
        }
    }


    public function update(Request $request)
    {

        $session = $request->session()->get('login_respondente');
        $respondente_id = $session['respondente_id'];
        $campanha_id = $session['campanha_id'];

        $status = CampanhaRespondente::where('campanha_id', $campanha_id)
            ->where('respondente_id', $respondente_id)
            ->first();

        $status->update(['respondida' => 'S']);

        if ($request->tipo_id == 4) {
            $resp = Resposta::updateOrCreate(
                [
                    'respondente_id' => $respondente_id,
                    'campanha_id' =>  $campanha_id,
                    'pergunta_id' => $request->pergunta_id,
                    'tipo_id' => $request->tipo_id
                ],
                ['texto_resposta' => $request->texto_resposta]
            );

            foreach ($request->opcao_id as $key => $resposta) {
                $opcaoResp = RespostaOpcao::updateOrCreate([
                    'pergunta_id' => $request->pergunta_id,
                    'opcao_resposta_id' => $key,
                    'resposta_id' => $resp->id,
                    'resposta' => $resposta,
                    'peso_resposta' => $request->peso_opcao
                ]);
            }
            $statusResposta = StatusRespondente::where('campanha_respondente_id', $status->id)
                ->where('pergunta_id', $request->pergunta_id)
                ->first();
            $statusResposta->update(['respondida' => 'S']);
        }  elseif ($request->tipo_id == 5) {

            $resp = Resposta::updateOrCreate(
                [
                    'respondente_id' => $respondente_id,
                    'campanha_id' =>  $campanha_id,
                    'pergunta_id' => $request->pergunta_id
                ],
                [
                    'tipo_id' => $request->tipo_id,
                    'texto_resposta' => $request->texto_resposta,
                ]
            );

            $statusResposta = StatusRespondente::where('campanha_respondente_id', $status->id)
                ->where('pergunta_id', $request->pergunta_id)
                ->first();

            $statusResposta->update(['respondida' => 'S']);
        } else {
            foreach ($request->pergunta_id as $key => $resposta) {
                $resp = Resposta::updateOrCreate(
                    [
                        'respondente_id' => $respondente_id,
                        'campanha_id' =>  $campanha_id,
                        'pergunta_id' => $key
                    ],
                    [
                        'tipo_id' => $request->tipo_id,
                        'opcao_resposta_id' => $request->pergunta_id[$key],
                        'texto_resposta' => $request->texto_resposta,
                        'peso_resposta' => $request->pergunta_id[$key],
                        'sim_nao' => $request->sim_nao
                    ]
                );

                $statusResposta = StatusRespondente::where('campanha_respondente_id', $status->id)
                    ->where('pergunta_id', $key)
                    ->first();

                $statusResposta->update(['respondida' => 'S']);
            }
        }
        return back();
    }
}
