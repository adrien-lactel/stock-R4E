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
        Schema::create('mod_repairer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mod_id')->constrained()->onDelete('cascade');
            $table->foreignId('repairer_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0)->comment('Quantité disponible chez ce réparateur');
            $table->timestamps();
            
            // Éviter les doublons
            $table->unique(['mod_id', 'repairer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_repairer');
    }
};
