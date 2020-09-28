<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(EmpresasDataSeeder::class);
        $this->call(OpcoesDataSeeder::class); 
    }
}
