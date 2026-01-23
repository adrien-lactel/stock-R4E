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
        // Vérifier si la table existe avant d'essayer de la modifier
        if (Schema::hasTable('gameboy_games')) {
            Schema::table('gameboy_games', function (Blueprint $table) {
                if (!Schema::hasColumn('gameboy_games', 'cloudinary_url')) {
                    $table->string('cloudinary_url')->nullable()->after('image_url');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('gameboy_games')) {
            Schema::table('gameboy_games', function (Blueprint $table) {
                if (Schema::hasColumn('gameboy_games', 'cloudinary_url')) {
                    $table->dropColumn('cloudinary_url');
                }
            });
        }
    }
};
