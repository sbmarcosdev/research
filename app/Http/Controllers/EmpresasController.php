<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $empresas = Empresa::whereIn('id', ['8','2','3'])->orderBy('nome', 'DESC')->get();
        return view('empresas.list', compact('empresas'));
    }

    public function tabela()
    {
        //$empresas = Empresa::get();
        return view('empresas.tablebootstrap');
    }

    public function create()
    {
        $empresas['nome'] = "";
        $empresas['dns'] = "";
        return view('empresas.frm', compact('empresas'));
    }

    public function edit($empresa_id)
    {
        $empresa = Empresa::find($empresa_id);
        
            return view('empresas.frm', compact('empresa'));
       
    }

    public function update(Request $request, $empresa_id)
    {
        $emp = Empresa::find($empresa_id);

        dd($request);

        $emp->update(['nome' => $request->nome,
                      'dns' => $request->dns  
                     ]);

        return redirect('empresas');
    }

    public function destroy(Empresa $empresa_id)
    {
        $empresa_id->destroy($empresa_id->id);
      
        return redirect('home');
    }
}
