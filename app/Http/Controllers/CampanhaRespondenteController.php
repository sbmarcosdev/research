<?php

namespace App\Http\Controllers;

set_time_limit(0);
ini_set('max_execution_time', 300);
set_time_limit(8000000);
ini_set("memory_limit", "10056M");

use App\Models\Campanha;
use App\Models\CampanhaRespondente;
use App\Models\Respondente;
use App\Models\StatusRespondente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampanhaRespondenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }
    
    public function show($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);
        
        $pesq=CampanhaRespondente::where('campanha_id', $campanha_id)->get();
        
        return view('importar.list', compact('pesq','campanha'));
    }

    public function export($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);

        $pesq = CampanhaRespondente::where('campanha_id', $campanha_id)->get();

        return view('importar.show', compact('pesq', 'campanha'));
    }

    public function edit($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);
    
        return view('importar.create', compact('campanha')); 
    }

    private function limparTexto($texto)
    {
        //$texto = htmlentities($texto, null, 'utf-8');
        $texto = str_replace("&nbsp;", " ", $texto);
        $texto = str_replace("\n", "", $texto);
        $texto = str_replace("\r", "", $texto);
        $texto = preg_replace('/\s/', ' ', $texto);
        return $texto;
    }

    public function update(Request $request, $id)
    {
        $path = $request->file('importar')->getRealPath();
        $dados = file($path);
        unset($dados[0]);
        foreach ($dados as $dad) {
            $partes = explode('|', $dad);

            //$salvar['nome'] = $this->limparTexto($partes[0]);
            $salvar['nome'] = $this->limparTexto($partes[0]);
            $salvar['email'] = $this->limparTexto($partes[1]);

            $inserido = Respondente::updateOrCreate($salvar);

            $dadosCampanha['campanha_id'] = $id;
            $dadosCampanha['respondente_id'] = $inserido->id; 

            $camp = CampanhaRespondente::updateOrCreate($dadosCampanha);

            $perguntas=$camp->campanha->perguntas;

            foreach ($perguntas as $perg ){
               $status = StatusRespondente::updateOrCreate([
                    'campanha_respondente_id' =>$camp->id, 
                    'pergunta_id' => $perg->id
                      ]);
           }
        }
        session()->put(['status_campanha' => 'img/status3.png',
                        'titulo_status' => 'Pesquisa Pronta para Envio aos Respondentes'
        ]);

        return redirect('/importar/'. $id);
    }

    public function destroy(Request $request)
    {
        $camp = CampanhaRespondente::find($request->campanha_respondente_id);
        
        $camp->delete();

        return redirect('/importar/'.$request->campanha_id);
    }
}
