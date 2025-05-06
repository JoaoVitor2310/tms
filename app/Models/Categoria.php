<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    public function anotacoes()
    {
        return $this->hasMany(Anotacao::class);
    }
}
