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
        // Modifier l'enum pour ajouter 'to_ship'
        DB::statement("ALTER TABLE consoles MODIFY COLUMN assignment_status ENUM('unassigned', 'pending_acceptance', 'accepted', 'received', 'to_ship') DEFAULT 'unassigned'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Retirer 'to_ship' de l'enum
        DB::statement("ALTER TABLE consoles MODIFY COLUMN assignment_status ENUM('unassigned', 'pending_acceptance', 'accepted', 'received') DEFAULT 'unassigned'");
    }
};
