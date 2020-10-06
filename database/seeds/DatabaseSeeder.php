<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(LoginAdminSeeder::class);
        $this->call(TipoDataSeeder::class); 
        $this->call(OpcaoDataSeeder::class);
        $this->call(TipoMensagemDataSeeder::class); 
    }
}
