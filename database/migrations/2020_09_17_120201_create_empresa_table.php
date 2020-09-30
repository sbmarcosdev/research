<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id()->comment('auto increment');
            $table->string('nome')->nullable()->comment('Nome da Empresa');
            $table->string('link_acesso')->nullable()->comment('Validacao da origem do acesso do cliente');
            $table->string('logo')->nullable()->comment('Logotipo da Empresa');
            $table->string('banner')->nullable()->comment('Banner identidade visual Empresa');
            $table->string('cor_primaria', 50)->nullable()->comment('Cor identidade visual Empresa');
            $table->string('cor_secundaria', 50)->nullable()->comment('Cor identidade visual Empresa');
            $table->string('cor_topo_rodape', 50)->nullable()->comment('Cor identidade visual Empresa');
        });
    }

    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
