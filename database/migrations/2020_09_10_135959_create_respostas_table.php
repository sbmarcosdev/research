<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespostasTable extends Migration
{
    public function up()
    {
        Schema::create('respostas', function (Blueprint $table) {
            $table->id();
            $table->char('respondente_id', 36)->nullable()->index('FK_campanha_respondente');
            $table->foreignId('campanha_id')->constrained()->onDelete('cascade');
            $table->foreignId('pergunta_id')->constrained()->onDelete('cascade');
            $table->foreignId('tipo_id')->constrained()->onDelete('cascade');
            $table->foreignId('opcao_resposta_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('texto_resposta')->nullable();
            $table->integer('peso_resposta')->nullable();
            $table->char('sim_nao', 1)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('respostas');
    }
}
