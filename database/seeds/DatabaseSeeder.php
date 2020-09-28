<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(EmpresasDataSeeder::class);
        $this->call(TipoDataSeeder::class); 
        $this->call(OpcaoDataSeeder::class); 
    }
}
