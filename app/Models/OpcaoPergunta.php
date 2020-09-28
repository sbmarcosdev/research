<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpcaoPergunta extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public function opcaoResposta()
    {
        return $this->belongsTo(OpcaoResposta::class);
    }
}
