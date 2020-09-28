<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDataSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/tipos.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            $salvar['id'] = $obj->id;
            $salvar['tipo'] = $obj->tipo;
            $salvar['quantidade'] = $obj->quantidade;
            DB::table('tipos')->insert($salvar);
        }
    }
}
