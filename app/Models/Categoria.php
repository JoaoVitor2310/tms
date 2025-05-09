<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nome', 'user_id'];

    public function anotacoes()
    {
        return $this->hasMany(Anotacao::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
