<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    use HasFactory;

    protected $fillable = ['compra_id', 'ingrediente_id', 'quantidade', 'preco_unitario'];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
