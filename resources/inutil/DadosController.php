<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class DadosController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.list', compact('empresas'));
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required',
            'dns' => 'required'
        ]);

        $insert = Empresa::create($validatedData);

        return redirect('/dados');
    }

    public function show($id)
    {
       $empresa = Empresa::find($id);
       
       return view('empresas.frm', compact('empresa'));
    }

    public function edit($id)    
    {
        $empresa = Empresa::find($id);
        return view('empresas.frm', compact('empresa'));
    }
    
    public function update(Request $request)
    {
        $emp = Empresa::find($request->id);

        $emp->update([
            'nome' => $request->nome,
            'dns' => $request->dns
        ]);

        return redirect('/dados');
    }

    public function destroy(Empresa $empresa_id)
    {
        $empresa_id->destroy($empresa_id->id);

        return redirect('/dados');
    }
}
