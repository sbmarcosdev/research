<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusRespondente extends Model
{
    protected $guarded = [];

    public function pergunta()
    {
        return $this->belongsTo(Pergunta::class);
    }

    public function campanha()
    {
        return $this->belongsTo(CampanhaRespondente::class);
    }
}
