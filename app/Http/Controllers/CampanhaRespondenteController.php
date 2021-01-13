<?php

namespace App\Http\Controllers;

// set_time_limit(0);
// ini_set('max_execution_time', 300);
// set_time_limit(8000000);
// ini_set("memory_limit", "10056M");

// ini_set('max_execution_time', 0);
// set_time_limit(0);
// ini_set('memory_limit', '-1');
// ini_set("memory_limit", "2048M");

use App\Models\Campanha;
use App\Models\CampanhaRespondente;
use App\Models\Pergunta;
use App\Models\Respondente;
use App\Models\StatusRespondente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CampanhaRespondenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }
    
    public function show($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);
        
        $pesq=CampanhaRespondente::where('campanha_id', $campanha_id)->paginate(100);
        
        return view('importar.index', compact('pesq','campanha'));
    }

    public function export($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);

        $pesq = CampanhaRespondente::where('campanha_id', $campanha_id)->paginate(100);

        return view('importar.show', compact('pesq', 'campanha'));
    }

    public function edit($campanha_id)
    {
        $campanha = Campanha::find($campanha_id);
    
        return view('importar.create', compact('campanha')); 
    }

    private function limparTexto($texto)
    {
        $texto = utf8_encode($texto);
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
        $salvar = [];
        $cr =[];
        $status =[];

        foreach ($dados as $dad) {

            $partes = explode('|', $dad);
            $nome = $this->limparTexto($partes[0]);
            $email = $this->limparTexto($partes[1]);
            $uuid = Str::uuid();
            
            array_push($salvar, ['id'=> $uuid, 'nome' => $nome, 'email' =>$email]);
            array_push($cr, ['respondente_id'=> $uuid, 'campanha_id'=>$id ]);

            }
        
       foreach (array_chunk($salvar,1000) as $t)  
            {
                Respondente::insert($t);
            }
       
        foreach (array_chunk($cr,1000) as $c)  
            {
                CampanhaRespondente::insert($c);
            }

        $sql = "SELECT email FROM embracon_satisfacao.respondentes group by email having count(email)>1";
         
        $duplicados = DB::select($sql);

        $d=0;

        foreach($duplicados as $dup){
        
            $doubleResp = Respondente::where('email', $dup->email)->first();

            $d++;

            $doubleResp->delete();
           
        }
  
        $query = "SELECT cr.id FROM campanha_respondentes cr left join status_respondentes sr on cr.id = sr.campanha_respondente_id 
            where sr.campanha_respondente_id is null and cr.campanha_id = $id";

        $campResp = DB::select($query);

        foreach ($campResp as $cResp){
        $perguntas = Pergunta::where('campanha_id', $id)->get();
            foreach ($perguntas as $perg ){   
                array_push($status, [
                    'campanha_respondente_id'=>$cResp->id, 
                    'pergunta_id' => $perg->id  
                    ]);
            }
        }
        
        foreach (array_chunk($status,1000) as $s){
                StatusRespondente::insert($s);
            }
        
        session()->put(['status_campanha' => 'img/status3.png',
                        'titulo_status' => 'Pesquisa Pronta para Envio aos Respondentes']);

       return redirect('/importar/'. $id)->with(['msg' => $d.' Registros em duplicidade não foram Importados']);
    }


    public function excluiImportacao($campanha_id)
    {

        $sql_delete = "DELETE from respondentes where id in 
        (select respondente_id from campanha_respondentes where campanha_id = 1)";

        DB::delete($sql_delete);
        return redirect('/importar/' . $campanha_id)->with(['msg' => 'Registros Excluídos']);
    }

    public function destroy(Request $request)
    {
        $camp = CampanhaRespondente::find($request->campanha_respondente_id);
        
        $resp = Respondente::find($camp->respondente_id);

        $resp->delete();

        $camp->delete();

        return redirect('/importar/'.$request->campanha_id);
    }
}
