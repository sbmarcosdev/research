<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresasController extends Controller
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
        if ($request->file('logo')) {
            $fileNameLogo = time() . '_' . $request->logo->getClientOriginalName();

            $filePathLogo = $request->logo->storeAs('public', $fileNameLogo);
        }

        if ($request->file('banner')) {
            $fileNameBanner = time() . '_' . $request->banner->getClientOriginalName();

            $filePathBanner = $request->banner->storeAs('public', $fileNameBanner);
        }

        Empresa::create([
            'nome' => $request->nome,
            'link_acesso' => $request->link_acesso,
            'logo' => $filePathLogo ?? '',
            'banner' => $filePathBanner ?? '',
            'cor_primaria' => $request->cor_primaria,
            'cor_secundaria' => $request->cor_secundaria,
            'cor_topo_rodape' => $request->cor_topo_rodape
        ]);

        return redirect('empresas');
    }


    public function edit($id)
    {
        $empresa = Empresa::find($id);

        return view('empresas.frm', compact('empresa'));
    }


    public function update(Request $request, $id)
    {
        if ($request->file('logo')) {
            $fileNameLogo = time() . '_' . $request->logo->getClientOriginalName();

            $filePathLogo = $request->logo->storeAs('public', $fileNameLogo);
        }

        if ($request->file('banner')) {
            $fileNameBanner = time() . '_' . $request->banner->getClientOriginalName();

            $filePathBanner = $request->banner->storeAs('public', $fileNameBanner);
        }

        $dados = [];
        $dados['nome'] = $request->nome;
        $dados['link_acesso'] = $request->link_acesso;
        $dados['cor_primaria'] = $request->cor_primaria;
        $dados['cor_secundaria'] = $request->cor_secundaria;
        $dados['cor_topo_rodape'] = $request->cor_topo_rodape;
        
        if (isset($filePathLogo))
            $dados['logo'] = $filePathLogo;

        if (isset($filePathBanner))
            $dados['banner'] = $filePathBanner;    
        
        $emp = Empresa::find($id);

        $emp->update($dados);

        return redirect('empresas');
    }

 
    public function destroy($id)
    {
        $emp = Empresa::find($id);
        $emp->delete();
        return redirect('empresas');
    }
}
