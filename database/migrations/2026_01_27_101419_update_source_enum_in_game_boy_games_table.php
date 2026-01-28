<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifier l'ENUM pour ajouter les nouvelles sources
        DB::statement("ALTER TABLE game_boy_games MODIFY COLUMN source ENUM('gbhwdb', 'fullset', 'merged', 'igdb', 'libretro', 'nointro', 'mame') DEFAULT 'merged'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revenir à l'ENUM original
        DB::statement("ALTER TABLE game_boy_games MODIFY COLUMN source ENUM('gbhwdb', 'fullset', 'merged') DEFAULT 'merged'");
    }
};
