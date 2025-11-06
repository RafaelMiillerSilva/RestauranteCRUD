<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    use HasFactory;

    protected $fillable = ['cliente_id', 'data', 'valor_total'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pratos()
    {
        return $this->belongsToMany(Prato::class)
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }

    public function itens()
    {
        return $this->hasMany(EncomendaItem::class);
    }
}
