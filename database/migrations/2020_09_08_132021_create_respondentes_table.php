<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespondentesTable extends Migration
{
    public function up()
    {
        Schema::create('respondentes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email')->unique();
            $table->string('nome');
            $table->char('sexo',1)->nullable();
            $table->char('estado',2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('respondentes');
    }
}
