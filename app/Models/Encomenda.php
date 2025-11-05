<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    //
    public function cliente() {
    return $this->belongsTo(Cliente::class);
    }
    public function pratos() {
        return $this->belongsToMany(Prato::class, 'encomenda_prato')->withPivot('quantidade');
    }

}
