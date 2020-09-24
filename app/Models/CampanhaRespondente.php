<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampanhaRespondente extends Model
{
    protected  $guarded = ['id'];

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }
    
    public function respondente()
    {
        return $this->belongsTo(Respondente::class);
    }

    public function status()
    {
        return $this->hasMany(StatusRespondente::class);
    }

}
