<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoMensagemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_mensagems', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->comment('Tipo Mensagem Campanha Encerrada|Expirada|Boas Vindas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipo_mensagem');
    }
}
