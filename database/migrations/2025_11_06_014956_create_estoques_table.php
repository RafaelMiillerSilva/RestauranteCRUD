<?php

// database/migrations/xxxx_xx_xx_create_estoque_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ingrediente_id')->constrained('ingredientes')->onDelete('cascade');
            $table->decimal('quantidade_atual', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};
