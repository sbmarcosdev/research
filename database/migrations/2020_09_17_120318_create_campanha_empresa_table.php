<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhaEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanha_empresa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_empresa')->nullable()->comment('referencia da tabela campanha');
            $table->integer('id_campanha')->nullable()->comment('Referencia da tabela empresa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campanha_empresa');
    }
}
