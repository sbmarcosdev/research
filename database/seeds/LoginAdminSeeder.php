<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoginAdminSeeder extends Seeder
{
    public function run()
    {
        $json = File::get('database/data/loginAdmin.json');
        $data = json_decode($json);
        foreach ($data as $obj) {
            
            $salvar['nome'] = $obj->nome;
            DB::table('login')->insert($salvar);
        }
    }
}
