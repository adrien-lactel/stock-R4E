<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('console_offers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('console_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('store_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('sale_price', 10, 2);

            $table->enum('status', ['proposed', 'sent', 'accepted'])
                ->default('proposed');

            $table->timestamps();

            // Contrainte : une console ne peut être proposée qu'une fois par magasin
            $table->unique(['console_id', 'store_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('console_offers');
    }
};
