<?php

// database/migrations/xxxx_xx_xx_create_prato_ingrediente_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('prato_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prato_id')->constrained('pratos')->onDelete('cascade');
            $table->foreignId('ingrediente_id')->constrained('ingredientes')->onDelete('cascade');
            $table->decimal('quantidade', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prato_ingrediente');
    }
};

