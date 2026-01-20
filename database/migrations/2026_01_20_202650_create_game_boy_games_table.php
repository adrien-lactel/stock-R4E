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
        Schema::create('game_boy_games', function (Blueprint $table) {
            $table->id();
            $table->string('rom_id')->unique()->nullable(); // DMG-XXX-X format
            $table->string('name');
            $table->string('year')->nullable(); // Peut contenir plusieurs années
            $table->string('image_url')->nullable(); // URL de l'image full-set.net
            $table->string('price')->nullable(); // Prix moyen (ex: "38.98 €")
            $table->enum('source', ['gbhwdb', 'fullset', 'merged'])->default('merged');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_boy_games');
    }
};
