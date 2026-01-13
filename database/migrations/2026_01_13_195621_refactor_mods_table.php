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
        Schema::table('mods', function (Blueprint $table) {
            // Supprimer la foreign key et colonne console_id
            $table->dropForeign(['console_id']);
            $table->dropColumn('console_id');
            
            // Ajouter les nouvelles colonnes
            $table->decimal('purchase_price', 10, 2)->after('name');
            $table->boolean('is_accessory')->default(false)->after('purchase_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mods', function (Blueprint $table) {
            $table->dropColumn(['purchase_price', 'is_accessory']);
            $table->foreignId('console_id')->after('id')->constrained()->onDelete('cascade');
        });
    }
};
