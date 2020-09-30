<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class EmpresasController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    
    public function index()
    {
        $empresas = Empresa::all();
        return view('empresas.list', compact('empresas'));
    }

    public function tabela()
    {
        //$empresas = Empresa::get();
        return view('empresas.tablebootstrap');
    }

    public function create()
    {
        return view('empresas.create');
    }

    public function edit($empresa_id)
    {
        $empresa = Empresa::find($empresa_id);
        
            return view('empresas.frm', compact('empresa'));
       
    }

    public function update(Request $request)
    {
         if ($request->file('logo')) {
            $fileName = time() . '_' . $request->logo->getClientOriginalName();
            
            $filePath = $request->logo->storeAs('public', $fileName);
            
        }

        $emp = Empresa::find($request->empresa_id);      

        $emp->update(['nome' => $request->nome,
                      'link_acesso' => $request->link_acesso,
                      'logo' => $filePath  
                     ]);

        return redirect('empresas');
    }

    public function store(Request $request)
    {
    

        if ($request->file('logo')) {
            $fileName = time() . '_' . $request->logo->getClientOriginalName();
            
            $filePath = $request->logo->storeAs('public', $fileName);
            
        }
       

       // $empresas = Empresa::all();

       // return view('empresas.list', compact('empresas'));
    }


    public function destroy(Empresa $empresa_id)
    {
        $empresa_id->destroy($empresa_id->id);
      
        return redirect('home');
    }
}
