<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemCompra extends Model
{
    protected $table = 'itens_compra';

    protected $fillable = [
        'compra_id',
        'ingrediente_id',
        'quantidade',
        'preco_unitario',
    ];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class);
    }

    public function ingrediente(): BelongsTo
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
