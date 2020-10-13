<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpcaoResposta extends Model
{
    protected $guarded=[];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function resposta()
    {
        return $this->hasMany(Resposta::class);
    }    
}
