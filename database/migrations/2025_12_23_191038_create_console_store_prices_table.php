<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('console_store_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('console_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('store_id')
                ->constrained()
                ->cascadeOnDelete();

            // Prix de vente spécifique pour ce magasin
            // null = console non visible pour ce magasin
            $table->decimal('sale_price', 8, 2)->nullable();

            $table->timestamps();

            // Empêche d’avoir deux prix pour la même console et le même magasin
            $table->unique(['console_id', 'store_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('console_store_prices');
    }
};
