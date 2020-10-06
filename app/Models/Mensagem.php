<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $table = 'mensagens';
    protected  $guarded = ['id'];
    
    public function tipoMensagem()
    {
        return $this->belongsTo(TipoMensagem::class);
    }

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }
}
