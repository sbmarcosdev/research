<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Respondente extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($resposta) {
            $resposta->{$resposta->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function respondente()
    {
        return $this->hasMany(Resposta::class);
    }

    public function campanhaRespondente()
    {
        return $this->hasMany(CampanhaRespondente::class);
    }

}
