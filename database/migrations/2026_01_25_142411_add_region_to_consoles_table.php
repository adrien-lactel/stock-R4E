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
            $table->enum('region', ['PAL', 'NTSC', 'NTSC-J', 'NTSC-U', 'Région libre'])
                  ->nullable()
                  ->after('article_type_id')
                  ->comment('Région de la console (PAL Europe, NTSC-J Japon, NTSC-U USA, Région libre)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn('region');
        });
    }
};
