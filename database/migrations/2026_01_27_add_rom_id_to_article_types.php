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
        Schema::table('article_types', function (Blueprint $table) {
            // Ajout du champ rom_id pour les jeux Game Boy
            $table->string('rom_id', 20)->nullable()->after('description');
            
            // Index pour les recherches rapides
            $table->index('rom_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_types', function (Blueprint $table) {
            $table->dropIndex(['rom_id']);
            $table->dropColumn('rom_id');
        });
    }
};
