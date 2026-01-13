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
        if (Schema::hasColumn('consoles', 'identite_reparateur')) {
            Schema::table('consoles', function (Blueprint $table) {
                $table->dropColumn('identite_reparateur');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('consoles', 'identite_reparateur')) {
            Schema::table('consoles', function (Blueprint $table) {
                $table->string('identite_reparateur')->nullable();
            });
        }
    }
};
