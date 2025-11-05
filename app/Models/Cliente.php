<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    public function encomendas() {
    return $this->hasMany(Encomenda::class);
}

    
}
