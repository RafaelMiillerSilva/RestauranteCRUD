<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('encomenda_itens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('encomenda_id')->constrained('encomendas')->onDelete('cascade');
            $table->foreignId('prato_id')->constrained('pratos')->onDelete('cascade');
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encomenda_itens');
    }
};

