<?php

namespace App\Http\Controllers;

use App\Models\Mensagem;
use Illuminate\Http\Request;

class MensagemController extends Controller
{
    
    public function edit($id)
    {
        $mensagem = Mensagem::find($id);
        
        return view('mensagens.frm', compact('mensagem'));
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
