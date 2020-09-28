<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    protected $guarded = [];

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function resposta()
    {
        return $this->hasMany(Resposta::class);
    }

    public function status()
    {
        return $this->hasMany(StatusRespondente::class);
    }

    public function opcoes()
    {
        return $this->hasMany(OpcaoPergunta::class);
    }
}
