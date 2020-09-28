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
            $salvar['id'] = $obj->id;
            $salvar['tipo_id'] = $obj->tipo_id;
            $salvar['titulo'] = $obj->titulo;
            $salvar['peso'] = $obj->peso;
            $salvar['ordem'] = $obj->ordem;
            DB::table('opcao_respostas')->insert($salvar);
        }
    }
}
