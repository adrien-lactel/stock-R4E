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
            $table->enum('completeness', ['Console seule', 'Avec boîte', 'Complète en boîte'])
                  ->nullable()
                  ->after('region')
                  ->comment('État de complétude : console seule, avec boîte, ou complète');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn('completeness');
        });
    }
};
