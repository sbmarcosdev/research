<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\OpcaoPergunta;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PerguntaController extends Controller
{
    public function __construct()
    {
        $this->middleware('ad_checked');
    }
    
    public function reorder(Request $request)
    {
        $request->validate([
            'ids'         => 'required|array',
            'ids.*'       => 'integer',
            'category_id' => 'required|integer|exists:campanhas,id',
        ]);

        foreach ($request->ids as $index => $id) {
            DB::table('perguntas')
                ->where('id', $id)
                ->update([
                    'ordem' => $index + 1,
                    'campanha_id' => $request->category_id
                ]);
        }

         $positions = Campanha::find($request->category_id)
             ->perguntas()
             ->pluck('ordem', 'id');

        return response(compact('positions'), Response::HTTP_OK);
    }

    public function create($id)
    {
        $campanha = Campanha::find($id);
        
        $numNova = $campanha->perguntas->sortByDesc('ordem')->first();

        if($numNova) $campanha->numNova = $numNova->ordem + 1;
        else $campanha->numNova = 1;

        $opcoes = OpcaoResposta::where('tipo_id',4)->get();
        
        return view('perguntas.create', compact('campanha', 'opcoes'));
    }


    public function show($id)
    {
        $campanha = Campanha::find($id);
        $campanha->temPerguntas = Pergunta::where('campanha_id', $id)->first();
        
        $perguntas = Pergunta::where('campanha_id', $id)->orderByRaw('ordem ASC')->get();

        return view('perguntas.list', compact('campanha','perguntas'));
    }

    public function edit($pergunta_id)
    {
        $pergunta = Pergunta::find($pergunta_id);

        return view('perguntas.frm', compact('pergunta'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'campanha_id' => 'required',
            'texto' => 'required',
            'texto_ajuda' => 'sometimes|nullable|max:191',
            'tipo_id' => 'required|int',
            'ordem' => 'sometimes|int'
        ]);

        $pergunta = Pergunta::updateOrCreate(['id' => $request->id], $validatedData );

        if (($pergunta->tipo_id == 1) || ($pergunta->tipo_id == 2) || ($pergunta->tipo_id == 3) || ($pergunta->tipo_id == 7)) {
            $opcoes = OpcaoResposta::where('tipo_id', $pergunta->tipo_id )->where('padrao','S')->get();
            
            foreach($opcoes as $opcao){
                OpcaoPergunta::create([
                    'pergunta_id'=>$pergunta->id,
                    'opcao_resposta_id' => $opcao->id
                ]);
            }
        }

        if ($pergunta->tipo_id == 4) {

            return redirect('/inserir-opcoes/' . $pergunta->id . '/create');
        }
        if ($pergunta->tipo_id == 6) {
            $opcoes = OpcaoResposta::where('tipo_id', 6)->get();
            return view('opcoes.list', compact('opcoes', 'pergunta'));
        } 
        
        session()->put([
            'status_campanha' => 'img/status2.png',
            'titulo_status' => 'Realize a Importação dos Participantes',
            'link_status' => 'importar/' . $pergunta->campanha_id
        ]);

        return redirect('/perguntas/' . $pergunta->campanha_id);

    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'campanha_id' => 'required',
            'texto' => 'required', 
            'texto_ajuda' => 'sometimes|nullable|max:191',
            'tipo_id' => 'required|int',
            'ordem' => 'sometimes|int'
        ]);

       $pergunta = Pergunta::updateOrCreate(['id' => $request->id], $validatedData );

        if ($pergunta->tipo_id == 4) {
           
            return redirect ('opcoes/'. $pergunta->id );
        }
        if ($pergunta->tipo_id == 6) {
            
            return redirect('opcoes/' . $pergunta->id);
        } 

        session()->put(['status_campanha' => 'img/status2.png',
                        'titulo_status' => 'Realize a Importação dos Participantes',
                        'link_status' => 'importar/' . $request->campanha_id
                        ]);
        
        return redirect('/perguntas/' . $request->campanha_id);
    }

    public function destroy(Request $request )
    {
        $delPerg = Pergunta::findOrFail($request->pergunta_id);
        
        $delPerg->delete();
        
        return redirect()->back()->with(['msg' => 'Pergunta excluída']);

    }
}
