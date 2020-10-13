<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcaoRespostasTable extends Migration
{
    public function up()
    {
        Schema::create('opcao_respostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_id')->constrained()->onDelete('cascade');
            $table->text('titulo');
            $table->integer('peso');
            $table->integer('ordem');
            $table->char('padrao')->default('N');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('opcao_respostas');
    }
}
