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
        Schema::table('consoles', function (Blueprint $table) {

            // Ajout UNIQUEMENT si la colonne n'existe pas déjà
            if (!Schema::hasColumn('consoles', 'admin_comment')) {
                $table->text('admin_comment')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            if (Schema::hasColumn('consoles', 'admin_comment')) {
                $table->dropColumn('admin_comment');
            }
        });
    }
};
