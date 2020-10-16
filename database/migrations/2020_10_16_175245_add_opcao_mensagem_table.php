<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOpcaoMensagemTable extends Migration
{
    public function up()
    {
        Schema::table('mensagens', function (Blueprint $table) {
            $table->char('opcao_sim')->nullable();
            $table->string('titulo_opcao_sim')->nullable();
            $table->char('opcao_nao')->nullable();
            $table->string('titulo_opcao_nao')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mensagens', function (Blueprint $table) {
            $table->dropColumn('opcao_sim');
            $table->dropColumn('titulo_opcao_sim');
            $table->dropColumn('opcao_nao');
            $table->dropColumn('titulo_opcao_nao');
        });
    }
}
