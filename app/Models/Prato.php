<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao', 'preco'];

    public function ingredientes()
    {
        return $this->belongsToMany(Ingrediente::class, 'prato_ingrediente')
                    ->withPivot('quantidade')
                    ->withTimestamps();
    }
}


