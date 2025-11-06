<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('itens_venda', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encomenda_id')->constrained('encomendas')->onDelete('cascade');
            $table->foreignId('prato_id')->constrained('pratos')->onDelete('cascade');
            $table->decimal('quantidade', 10, 2);
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itens_venda');
    }
};
