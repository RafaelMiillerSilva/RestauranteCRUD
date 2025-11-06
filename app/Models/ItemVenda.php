<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVenda extends Model
{
    protected $table = 'itens_venda';

    protected $fillable = [
        'encomenda_id',
        'prato_id',
        'quantidade',
        'preco_unitario',
    ];

    public function encomenda(): BelongsTo
    {
        return $this->belongsTo(Encomenda::class);
    }

    public function prato(): BelongsTo
    {
        return $this->belongsTo(Prato::class);
    }
}
