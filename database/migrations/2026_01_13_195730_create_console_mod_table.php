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
        Schema::create('console_mod', function (Blueprint $table) {
            $table->id();
            $table->foreignId('console_id')->constrained()->onDelete('cascade');
            $table->foreignId('mod_id')->constrained()->onDelete('cascade');
            $table->foreignId('repairer_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('price_applied', 10, 2)->comment('Prix du mod au moment de l\'application');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Index unique pour éviter les doublons
            $table->unique(['console_id', 'mod_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('console_mod');
    }
};
