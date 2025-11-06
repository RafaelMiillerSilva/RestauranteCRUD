<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->string('nota_fiscal')->unique();
            $table->string('fornecedor');
            $table->date('data_compra');
            $table->decimal('valor_total', 10, 2)->default(0); // usado no dashboard
            $table->string('status')->default('pendente'); // usado no dashboard
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
