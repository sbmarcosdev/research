<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpcaoDataSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/opcoes.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            $salvar['tipo_id'] = $obj->tipo_id;
            $salvar['titulo'] = $obj->titulo;
            $salvar['peso'] = $obj->peso;
            $salvar['ordem'] = $obj->ordem;
            $salvar['padrao'] = $obj->padrao;
            DB::table('opcao_respostas')->insert($salvar);
        }
    }
}
