<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['nota_fiscal', 'fornecedor', 'data_compra', 'valor_total'];

    public function itens()
    {
        return $this->hasMany(ItemCompra::class);
    }
}
