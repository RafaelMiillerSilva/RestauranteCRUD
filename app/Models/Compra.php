<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //
    public function ingredientes() {
    return $this->belongsToMany(Ingrediente::class, 'compra_ingrediente')
                ->withPivot('quantidade', 'preco_unitario');
    }

}
