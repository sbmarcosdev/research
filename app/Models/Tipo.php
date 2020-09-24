<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $guarded = [];
   
    public function opcao()
    {
        return $this->belongsTo(OpcaoResposta::class);
    }
}
