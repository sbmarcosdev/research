<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresasDataSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/empresas.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            $salvar['id'] = $obj->id;
            $salvar['nome'] = $obj->nome;
            $salvar['dns'] = $obj->dns;
            $salvar['logo'] = $obj->logo;
            $salvar['banner'] = $obj->banner;
            $salvar['cor_primaria'] = $obj->cor_primaria;
            $salvar['cor_secundaria'] = $obj->cor_secundaria;
            $salvar['unidade_negocio'] = $obj->unidade_negocio;
            $salvar['site'] = $obj->site;
            $salvar['dados_contato'] = $obj->dados_contato;
            DB::table('empresas')->insert($salvar);
        }
    }
}
