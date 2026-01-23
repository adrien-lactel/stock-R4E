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
        // Use raw SQL to modify the column since Laravel's change() doesn't always work
        DB::statement('ALTER TABLE mods MODIFY COLUMN icon TEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE mods MODIFY COLUMN icon VARCHAR(10) NOT NULL DEFAULT "🔧"');
    }
};
