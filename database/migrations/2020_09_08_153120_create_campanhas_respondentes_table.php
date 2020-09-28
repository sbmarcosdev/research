<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampanhasRespondentesTable extends Migration
{
    public function up()
    {
        Schema::create('campanha_respondentes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campanha_id')->constrained();
            $table->char('respondente_id',36);
            $table->foreign('respondente_id')->references('id')->on('respondentes')->onDelete('cascade');
            $table->char('respondida', 1)->default('N');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('campanha_respondentes');
    }
}
