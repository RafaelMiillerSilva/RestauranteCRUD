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
        Schema::create('prato_ingrediente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prato_id')->constrained()->onDelete('cascade');
            $table->foreignId('ingrediente_id')->constrained()->onDelete('cascade');
            $table->decimal('quantidade', 10, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prato_ingrediente');
    }
};
