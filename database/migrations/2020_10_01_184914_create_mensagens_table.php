<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensagensTable extends Migration
{
      public function up()
    {
        Schema::create('mensagens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campanha_id')->constrained()->comment('relacionamento tabela campanhas');
            $table->text('texto_descricao')->nullable()->comment('Descricao interna sobre a campanha');
            $table->text('texto_email')->nullable()->comment('mensagem marketing digital');
            $table->text('boas_vindas')->nullable()->comment('mensagem inicial da campanha');
            $table->text('expirada')->nullable()->comment('mensagem para campanha fora de data');
            $table->text('finalizada')->nullable()->comment('mensagem apos todas as perguntas respondidas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensagens');
    }
}
