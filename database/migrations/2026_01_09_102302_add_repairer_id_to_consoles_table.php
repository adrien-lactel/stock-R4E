<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->foreignId('repairer_id')
                ->nullable()
                ->after('identite_reparateur') // ou où tu veux
                ->constrained('repairers')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropForeign(['repairer_id']);
            $table->dropColumn('repairer_id');
        });
    }
};
