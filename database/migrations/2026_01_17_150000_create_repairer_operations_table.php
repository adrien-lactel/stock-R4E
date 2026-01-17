<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Table pivot pour les compétences des réparateurs (opérations qu'ils savent faire)
     */
    public function up(): void
    {
        Schema::create('repairer_operations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repairer_id')->constrained()->onDelete('cascade');
            $table->foreignId('mod_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['repairer_id', 'mod_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairer_operations');
    }
};
