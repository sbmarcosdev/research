<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasTable extends Migration
{
    public function up()
    {
        Schema::create('perguntas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campanha_id')->constrained()->onDelete('cascade');
            $table->text('texto');
            $table->string('texto_ajuda',191)->nullable();
            $table->foreignId('tipo_id')->constrained()->onDelete('cascade');
            $table->integer('ordem')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perguntas');
    }
}
