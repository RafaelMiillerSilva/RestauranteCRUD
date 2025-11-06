<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'unidade_medida'];

    public function pratos()
    {
        return $this->belongsToMany(Prato::class, 'prato_ingrediente')
                    ->withPivot('quantidade')
                    ->withTimestamps();
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }
}


