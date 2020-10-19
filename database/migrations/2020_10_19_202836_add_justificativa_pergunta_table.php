<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJustificativaPerguntaTable extends Migration
{
    public function up()
    {
        Schema::table('perguntas', function (Blueprint $table) {
            $table->char('opcao_justificativa')->nullable();
            $table->string('titulo_justificativa')->nullable();
        });
    }

    public function down()
    {
        Schema::table('perguntas', function (Blueprint $table) {
            $table->dropColumn('opcao_justificativa');
            $table->dropColumn('titulo_justificativa');
        });
    }
}
