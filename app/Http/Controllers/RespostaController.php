<?php

namespace App\Http\Controllers;

use App\Models\CampanhaRespondente;
use hisorange\BrowserDetect\Parser;
use App\Models\Mensagem;
use App\Models\OpcaoPergunta;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use App\Models\Resposta;
use App\Models\RespostaOpcao;
use App\Models\StatusRespondente;
use Carbon\Carbon;
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
            } elseif ($resp->campanha->data_termino <= date('Y-m-d')) {
                // data invalida, exibe msg de campanha Expirada     
                $msg = ['primeiro_acesso' => false];
                $msg = Mensagem::where('campanha_id', $campanha_id)->where('tipo_mensagem_id', 5)->first();
                // $msg->primeiro_acesso = false;
                $request->session()->flush();

                return view('respostas.msg', compact('msg'));
            } elseif ($resp->campanha->data_inicio >= date('Y-m-d')) {
                // data invalida, exibe msg de campanha Não  Iniciada     
                $msg = ['primeiro_acesso' => false];
                $msg = Mensagem::where('campanha_id', $campanha_id)->where('tipo_mensagem_id', 3)->first();
                //
                $request->session()->flush();

                return view('respostas.msg', compact('msg'));
            }
        } else {
            $request->session()->flush();
            $erro = ['erro' => 'Dados Não Localizados para esta Campanha'];
            return view('respostas.erro', compact('erro'));
        }
    }

    public function edit(Request $request)
    {
        if ($session = $request->session()->get('login_respondente')) {


            $respondente_id = $session['respondente_id'];
            $campanha_id = $session['campanha_id'];

            $resp = CampanhaRespondente::where('respondente_id', $respondente_id)
                ->where('campanha_id', $campanha_id)
                ->first();

            $resta = count($resp->status->where('respondida', 'N'));
            $total = count($resp->status);
            $respondidas = 1 + count($resp->status->where('respondida', 'S'));


            session()->put([
                'logo_empresa' => $resp->campanha->empresa->logo,
                'banner_empresa' => $resp->campanha->empresa->banner,
                'cor_topo_rodape' => $resp->campanha->empresa->cor_topo_rodape,
                'cor_primaria' => $resp->campanha->empresa->cor_primaria,
                'cor_secundaria' => $resp->campanha->empresa->cor_secundaria
            ]);

            if (($resta == $total) && ($resp->respondida == 'N')) {

                $msg = Mensagem::where('campanha_id', $campanha_id)->where('tipo_mensagem_id', 2)->first();
                
                $msg->primeiro_acesso = true;

                $inicio_resposta = Carbon::now();

                if (isset($_SERVER["HTTP_REFERER"]))
                    $refer = $_SERVER["HTTP_REFERER"];
                else
                    $refer = null;

                $resp->update([
                    'inicio_resposta' => $inicio_resposta,
                    'termino_resposta' => $inicio_resposta,
                    'HTTP_USER_AGENT' => $_SERVER["HTTP_USER_AGENT"],
                    'REMOTE_ADDR' => $_SERVER["REMOTE_ADDR"],
                    'HTTP_REFERER' =>  $refer
                ]);

                // primeiro acesso, marca como Acessada, proximo acesso não exibe Mensagem de Introducao   
                return view('respostas.msg', compact('msg'));
            }

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

            $qtd = $respondidas . "/" . $total;
            $progresso =  $respondidas / $total * 100;

            if ($resta) {
                
                $resp->update(['respondida' => 'A']); // atualiza status campanha acessada
                
                // falta alguma pergunta a ser respondida ?
                foreach ($preguntasOrdenadas as $listaPergunta) {

                    $pergunta = Pergunta::find($listaPergunta->pergunta_id);

                    if ($pergunta->tipo_id == 1) {

                        $opcoes = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                            ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                            ->where('perguntas.id', $pergunta->id)
                            ->where('opcao_respostas.tipo_id', 1)->orderBy('opcao_respostas.ordem','DESC')->get();

                        return view('respostas.classificatoria', compact('resp', 'pergunta', 'opcoes', 'qtd', 'progresso'));

                    } elseif ($pergunta->tipo_id == 2) {

                        $opcoesNum = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                            ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                            ->where('perguntas.id', $pergunta->id)
                            ->where('opcao_respostas.tipo_id', 2)->get();

                        return view('respostas.listNum', compact('resp', 'pergunta', 'opcoesNum', 'qtd', 'progresso'));

                    } elseif ($pergunta->tipo_id == 3) {

                        $afirmativa = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                            ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                            ->where('perguntas.id', $pergunta->id)
                            ->where('opcao_respostas.tipo_id', 3)->get();

                        return view('respostas.afirmativa', compact('resp', 'pergunta', 'afirmativa', 'qtd', 'progresso'));

                    } elseif ($pergunta->tipo_id == 4) {

                        $multipla = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                            ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                            ->where('perguntas.id', $pergunta->id)
                            ->where('opcao_respostas.tipo_id', 4)->get();

                        return view('respostas.multipla', compact('resp', 'pergunta', 'multipla', 'qtd', 'progresso'));

                    } elseif ($pergunta->tipo_id == 5) {

                        return view('respostas.descritiva', compact('resp', 'pergunta', 'qtd', 'progresso'));

                    } elseif ($pergunta->tipo_id == 6) {

                        $opcoes = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                            ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                            ->where('perguntas.id', $pergunta->id)
                            ->where('opcao_respostas.tipo_id', 6)->get();

                        return view('respostas.personalizada', compact('resp', 'pergunta', 'opcoes', 'qtd', 'progresso'));

                    } elseif ($pergunta->tipo_id == 7) {

                        $opcoes = OpcaoPergunta::join('perguntas', 'pergunta_id', '=', 'perguntas.id')
                            ->join('opcao_respostas', 'opcao_resposta_id', '=', 'opcao_respostas.id')
                            ->where('perguntas.id', $pergunta->id)
                            ->where('opcao_respostas.tipo_id', 7)->get();

                        return view('respostas.estrela', compact('resp', 'pergunta', 'opcoes', 'qtd', 'progresso'));
                    }
                    
                    $fimResp = Carbon::now();

                    $resp->update(['termino_resposta' => $fimResp]);
                }
            } 
            else {
                // Finalizada com Sucesso
                $request->session()->forget('login_respondente');

                $fimResp = Carbon::now();
                $resp->update(['termino_resposta' => $fimResp]);

                $msg = Mensagem::where('campanha_id', $campanha_id)->where('tipo_mensagem_id', 4)->first();
                return view('respostas.msg', compact('msg'));
            }
        } else {
            // Finalizada com Erro
            $request->session()->flush();
            $erro = ['erro' => 'Finalizado'];

            return view('respostas.erro', compact('erro'));
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

        $statusResposta = StatusRespondente::where('campanha_respondente_id', $status->id)
            ->where('pergunta_id', $request->pergunta_id)
            ->first();

        $statusResposta->update(['respondida' => 'S']);

        if ($request->tipo_id == 4) {
            $resp = Resposta::updateOrCreate(
                [
                    'respondente_id' => $respondente_id,
                    'campanha_id' =>  $campanha_id,
                    'pergunta_id' => $request->pergunta_id
                ],
                [
                    'opcao_resposta_id' => null,
                    'peso_resposta' => $request->peso_resposta,
                    'tipo_id' => $request->tipo_id,
                    'texto_resposta' => $request->texto_resposta,
                ]
            );
            if ($request->opcao_id) {
                foreach ($request->opcao_id as $key => $resposta) {
                    $opcaoResp = RespostaOpcao::updateOrCreate(
                        [
                            'pergunta_id' => $request->pergunta_id,
                            'opcao_resposta_id' => $key,
                            'resposta_id' => $resp->id,
                            'resposta' => $resposta,
                            'peso_resposta' => $request->peso_opcao
                        ]
                    );
                }
            }
        } else {
            $opcao = OpcaoResposta::where('tipo_id', $request->tipo_id)
                ->where('peso', $request->peso_resposta)
                ->first();

            $resp = Resposta::updateOrCreate(
                [
                    'respondente_id' => $respondente_id,
                    'campanha_id' =>  $campanha_id,
                    'pergunta_id' => $request->pergunta_id
                ],
                [
                    'opcao_resposta_id' => $opcao->id,
                    'peso_resposta' => $request->peso_resposta,
                    'tipo_id' => $request->tipo_id,
                    'texto_resposta' => $request->texto_resposta,
                ]
            );

            $opcaoResp = RespostaOpcao::updateOrCreate(
                [
                    'pergunta_id' => $request->pergunta_id,
                    'opcao_resposta_id' => $opcao->id,
                    'resposta_id' => $resp->id,
                    'resposta' => $request->peso_resposta,
                    'peso_resposta' => $request->peso_resposta
                ]
            );
        }
        return back();
    }
}
