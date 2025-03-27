<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especial extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'categoria', 'tipo'];

    public function fotos()
    {
        return $this->hasMany(EspecialFoto::class);
    }
}