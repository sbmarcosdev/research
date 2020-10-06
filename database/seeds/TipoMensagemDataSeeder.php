<?php

use Illuminate\Database\Seeder;

class TipoMensagemDataSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/tipo_mensagems.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            $salvar['tipo'] = $obj->tipo;
            DB::table('tipo_mensagems')->insert($salvar);
        }
    }
}
