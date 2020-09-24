<?php

namespace App\Http\Controllers;

use App\Models\OpcaoResposta;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OpcoesController extends Controller
{
   public function index()
   {
       return view('perguntas.teste');
   }
   
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tipo_id' => 'required|int',
            'peso' => 'required|int',
            'ordem' => 'required|int',
            'titulo' => 'required|string|max:191'
        ]);

        $positions = OpcaoResposta::create($validatedData);

        return response(compact('positions'), Response::HTTP_OK);
    }

    public function salvar(Request $request)
    {
        $ins = OpcaoPergunta::create([]);
    }
}
