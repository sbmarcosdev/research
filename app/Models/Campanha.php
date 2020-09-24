<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campanha extends Model
{
     protected  $guarded = ['id'];

     public function campanhaRespondente()
     {
          return $this->hasMany(CampanhaRespondente::class);
     }

     public function perguntas()
     {
          return $this->hasMany(Pergunta::class);
     }

     public function respostas()
     {
          return $this->hasMany(Resposta::class);
     } 
}
