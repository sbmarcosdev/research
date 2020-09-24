<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nome')->nullable();
            $table->string('dns')->nullable();
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->string('cor_primaria', 50)->nullable();
            $table->string('cor_secundaria', 50)->nullable();
            $table->string('unidade_negocio')->nullable();
            $table->string('site')->nullable();
            $table->text('dados_contato')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
