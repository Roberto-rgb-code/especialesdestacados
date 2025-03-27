<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspecialFoto extends Model
{
    protected $fillable = ['especial_id', 'foto_path'];

    public function especial()
    {
        return $this->belongsTo(Especial::class);
    }
}