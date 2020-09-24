<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\CampanhaRespondente;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use App\Models\Resposta;
use App\Models\RespostaOpcao;
use App\Models\StatusRespondente;
use Illuminate\Http\Request;

class RespostaController extends Controller
{

    public function login(Request $request, $campanha_id, $respondente_id)
    {
        $varSessao = [];
        $varSessao['campanha_id'] = $campanha_id;
        $varSessao['respondente_id'] = $respondente_id;

        if ($resp = CampanhaRespondente::where('respondente_id', $respondente_id)
            ->where('campanha_id', $campanha_id)
            ->first()){    
                if (($resp->campanha->data_inicio <= date('Y-m-d'))
                && ($resp->campanha->data_termino >= date('Y-m-d'))) {
                    $request->session()->put(['login_respondente' => $varSessao]);
                    return redirect('resposta');
                }
                else {
                    $request->session()->flush();
                    $erro = ['erro' => 'Campanha Encerrada'];
                    return view('respostas.erro', compact('resp','erro'));
                }
            }
        else
        {
            $request->session()->flush();
            $erro = ['erro'=>'Dados Não Localizados para esta Campanha'];
            return view('respostas.erro', compact('erro'));
        }
    }

    public function edit(Request $request)
    {
        $session = $request->session()->get('login_respondente');
        
        $resp = CampanhaRespondente::where('respondente_id', $session['respondente_id'])
            ->where('campanha_id', $session['campanha_id'])
            ->first();
                
        $resta = count($resp->status->where('respondida', 'N'));
        
        $total = count($resp->status);

        $respondidas = 1 + count($resp->status->where('respondida', 'S'));
        
        $resp->qtd = $respondidas."/".$total;

        $resp->progresso =  $respondidas / $total * 100;

                if(!$resta) {
                    
                    $request->session()->flush();
                    $msg = ['msg' => 'Avaliação Registrada com Sucesso. Muito obrigado por participar! '];
                    return view('respostas.msg', compact('msg'));
                }   
                else
                    {
                    
                    foreach($resp->status->where('respondida','N')  as $listaPergunta)
                        {
                     
                        $pergunta = Pergunta::find($listaPergunta->pergunta_id);
                        
                        
                        
                        if ($pergunta->tipo_id == 1)
                        {
                            $opcoes = OpcaoResposta::where('tipo_id', 1)->get();
                            return view('respostas.classificatoria', compact('resp', 'pergunta', 'opcoes'));
                        }
                        elseif ($pergunta->tipo_id == 2) 
                        {
                            $opcoesNum = OpcaoResposta::where('tipo_id', 2)->get();
                            return view('respostas.listNum', compact('resp', 'pergunta', 'opcoesNum'));
                        } 
                        elseif ($pergunta->tipo_id == 3) 
                        {
                            $afirmativa = OpcaoResposta::where('tipo_id', 3)->get();
                            return view('respostas.afirmativa', compact('resp', 'pergunta', 'afirmativa'));        
                        }    
                        elseif ($pergunta->tipo_id == 4) 
                        {
                            $multipla = OpcaoResposta::where('tipo_id', 4)->get();
                            return view('respostas.multipla', compact('resp', 'pergunta', 'multipla'));        
                        } 
                        elseif ($pergunta->tipo_id == 5) 
                        {
                            return view('respostas.descritiva', compact('resp', 'pergunta'));    
                        }
                    }
                } 
            }
        

    public function update(Request $request)
    {

        $session = $request->session()->get('login_respondente');
        $respondente_id = $session['respondente_id'];
        $campanha_id = $session['campanha_id'];

        $status = CampanhaRespondente::where('campanha_id',$campanha_id)
                                     ->where('respondente_id', $respondente_id)
                                     ->first();

        if ($request->tipo_id == 4)
        {
            $resp = Resposta::updateOrCreate([
                'respondente_id' => $respondente_id,
                'campanha_id' =>  $campanha_id,
                'pergunta_id' => $request->pergunta_id,
                'tipo_id' => $request->tipo_id,
                'texto_resposta' => 'multipla escolha'
            ]);
            
            foreach ($request->opcao_id as $key => $resposta) 
            {
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
        }
        elseif ($request->tipo_id == 5) {
            
                $resp = Resposta::updateOrCreate([
                    'respondente_id' => $respondente_id,
                    'campanha_id' =>  $campanha_id,
                    'pergunta_id' => $request->pergunta_id,
                    'tipo_id' => $request->tipo_id,
                    'texto_resposta' => $request->texto_resposta,
                ]);

                $statusResposta = StatusRespondente::where('campanha_respondente_id', $status->id)
                                                   ->where('pergunta_id', $request->pergunta_id)
                                                   ->first();

                $statusResposta->update(['respondida' => 'S']);  
            } 
            else
            {
                foreach ($request->pergunta_id as $key => $resposta) {
                $resp = Resposta::updateOrCreate([
                    'respondente_id' => $respondente_id,
                    'campanha_id' =>  $campanha_id,
                    'pergunta_id' => $key,
                    'tipo_id' => $request->tipo_id,
                    'texto_resposta' => $request->pergunta_id[$key],
                    'numero_resposta' => $request->pergunta_id[$key],
                    'peso_resposta' => $request->pergunta_id[$key],
                    'sim_nao' => $request->sim_nao
                ]);

                $statusResposta = StatusRespondente::where('campanha_respondente_id', $status->id)
                    ->where('pergunta_id', $key)
                    ->first();

                $statusResposta->update(['respondida' => 'S']);
            }
        }
        return back();
    }
}
