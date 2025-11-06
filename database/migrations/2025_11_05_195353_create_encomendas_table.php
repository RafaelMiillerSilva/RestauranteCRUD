<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('encomendas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->date('data');
            $table->decimal('valor_total', 10, 2)->default(0); // padronizado com o dashboard
            $table->string('status')->default('pendente'); // usado no dashboard
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encomendas');
    }
};
