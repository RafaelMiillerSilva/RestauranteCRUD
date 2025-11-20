<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoques';

    protected $fillable = ['ingrediente_id', 'quantidade'];

    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class);
    }
}


