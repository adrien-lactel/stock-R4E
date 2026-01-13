<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repairers', function (Blueprint $table) {
            $table->id();

            $table->string('name');                 // obligatoire
            $table->string('email')->nullable();    // optionnel
            $table->string('phone')->nullable();    // optionnel

            $table->string('city')->nullable();     // optionnel
            $table->string('address')->nullable();  // optionnel

            $table->text('notes')->nullable();      // optionnel (spécialités, conditions, etc.)
            $table->boolean('is_active')->default(true);

            $table->unsignedInteger('delay_days_default')->nullable(); // délai moyen
            $table->string('shipping_method')->nullable();             // transport préféré

            $table->string('vat_number')->nullable(); // TVA (si besoin)
            $table->string('siret')->nullable();      // SIRET (si France)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repairers');
    }
};
