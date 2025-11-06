<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    protected $fillable = ['nota_fiscal', 'fornecedor', 'data_compra', 'valor_total', 'status'];

    public function itens(): HasMany
    {
        return $this->hasMany(ItemCompra::class);
    }

    // Atualiza o valor total automaticamente
    public function atualizarValorTotal()
    {
        $this->valor_total = $this->itens->sum(function ($item) {
            return $item->quantidade * $item->preco_unitario;
        });
        $this->save();
    }
}
