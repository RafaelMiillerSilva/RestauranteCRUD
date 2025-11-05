<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prato extends Model
{
    //
    public function ingredientes() {
    return $this->belongsToMany(Ingrediente::class, 'prato_ingrediente')->withPivot('quantidade');
}

}
