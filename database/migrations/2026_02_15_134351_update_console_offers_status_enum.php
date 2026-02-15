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
        Schema::table('console_offers', function (Blueprint $table) {
            // Étendre l'enum status avec les nouveaux statuts
            DB::statement("ALTER TABLE console_offers MODIFY COLUMN status ENUM('proposed', 'sent', 'accepted', 'rejected', 'validated_buy', 'validated_consignment', 'shipped', 'received') NOT NULL DEFAULT 'proposed'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('console_offers', function (Blueprint $table) {
            // Retour à l'ancien enum (attention : perte de données si les nouveaux statuts sont utilisés)
            DB::statement("ALTER TABLE console_offers MODIFY COLUMN status ENUM('proposed', 'sent', 'accepted') NOT NULL DEFAULT 'proposed'");
        });
    }
};
