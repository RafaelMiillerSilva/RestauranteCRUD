<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Encomenda extends Model
{
    protected $fillable = ['cliente_id', 'data', 'valor_total', 'status'];

    // Relação com itens da encomenda
    public function itens(): HasMany
    {
        return $this->hasMany(ItemVenda::class, 'encomenda_id');
    }

    // Relação com cliente
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    // Atualiza o valor total da encomenda
    public function atualizarValorTotal()
    {
        $this->valor_total = $this->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });
        $this->save();
    }
}
