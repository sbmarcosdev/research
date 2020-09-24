<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    protected $guarded = [];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public function respondente()
    {
        return $this->belongsTo(Respondente::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function opcaoResposta()
    {
        return $this->belongsTo(OpcaoResposta::class);
    }
}
