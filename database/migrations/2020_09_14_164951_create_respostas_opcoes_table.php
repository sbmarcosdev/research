<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostasOpcoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respostas_opcoes', function (Blueprint $table) {
            $table->foreignId('pergunta_id')->constrained()->onDelete('cascade');
            $table->foreignId('opcao_resposta_id')->constrained()->onDelete('cascade');
            $table->foreignId('resposta_id')->constrained()->onDelete('cascade');
            $table->char('resposta',3)->nullable();
            $table->integer('peso_resposta')->nullable();
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
        Schema::dropIfExists('respostas_opcoes');
    }
}
