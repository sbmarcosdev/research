<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusRespondentesTable extends Migration
{

    public function up()
    {
        Schema::create('status_respondentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campanha_respondente_id')->constrained();
            $table->foreignId('pergunta_id')->constrained();
            $table->char('respondida',1)->default('N');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('status_respondentes');
    }
}
