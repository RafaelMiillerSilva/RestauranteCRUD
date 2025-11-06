<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncomendaItem extends Model
{
    use HasFactory;

    protected $fillable = ['encomenda_id', 'prato_id', 'quantidade', 'preco_unitario'];

    public function prato()
    {
        return $this->belongsTo(Prato::class);
    }

    public function encomenda()
    {
        return $this->belongsTo(Encomenda::class);
    }
}

