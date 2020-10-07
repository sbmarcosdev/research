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
            $table->foreignId('campanha_id')->constrained()->onDelete('cascade')->comment('relacionamento tabela campanhas');
            $table->foreignId('tipo_mensagem_id')->constrained()->onDelete('cascade')->comment('relacionamento tabela tipo_mensagem');
            $table->text('texto_mensagem')->nullable()->onDelete('cascade')->comment('Descricao interna sobre a campanha');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mensagens');
    }
}
