<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespostaOpcao extends Model
{
    protected $table = 'respostas_opcoes';
    
    protected $guarded = [];

    public function pergunta()
    {
        return $this->belongsTo(Resposta::class);
    }
}
