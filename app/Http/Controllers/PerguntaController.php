<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Models\OpcaoResposta;
use App\Models\Pergunta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PerguntaController extends Controller
{    
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'campanha_id' => 'required',
            'texto' => 'required|string|max:191',
            'tipo_id' => 'required|int',
            'ordem' => 'sometimes|int'
        ]);

        $insert = Pergunta::create($validatedData);

        return redirect('/perguntas/'. $insert->campanha_id );
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

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'campanha_id' => 'required',
            'texto' => 'required|string|max:191',
            'tipo_id' => 'required|int',
            'ordem' => 'sometimes|int'
        ]);

        Pergunta::where('id', $request->id)->update($validatedData);

        return redirect('/perguntas/' . $request->campanha_id);
    }

    public function destroy(Request $request )
    {
        $delPerg = Pergunta::findOrFail($request->pergunta_id);
        
        $delPerg->delete();
        
        return redirect()->back()->with(['msg' => 'Pergunta excluída']);

    }
}
