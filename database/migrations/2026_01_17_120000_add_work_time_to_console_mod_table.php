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
        Schema::table('console_mod', function (Blueprint $table) {
            $table->unsignedInteger('work_time_minutes')->nullable()->after('notes')
                  ->comment('Temps de travail en minutes pour l\'application du mod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('console_mod', function (Blueprint $table) {
            $table->dropColumn('work_time_minutes');
        });
    }
};
