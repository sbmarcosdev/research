<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhasTable extends Migration
{
    public function up()
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->unique();
            $table->date('data_inicio')->comment('Validade da Campanha');
            $table->date('data_termino')->comment('Validade da Campanha');
            $table->char('status', 1)->default(1)->comment('Ativo 1 | Inativo 0');
            $table->foreignId('empresa_id')->constrained()->comment('Referencia da tabela empresa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campanhas');
    }
}
