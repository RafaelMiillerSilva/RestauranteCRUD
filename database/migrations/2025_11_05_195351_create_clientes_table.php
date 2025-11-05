<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id(); // Cria o campo 'id' auto incremental (chave primária)
            $table->string('nome'); // Nome do cliente
            $table->string('endereco'); // Endereço completo
            $table->string('telefone', 20); // Telefone com tamanho máximo de 20 caracteres
            $table->timestamps(); // Campos created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};