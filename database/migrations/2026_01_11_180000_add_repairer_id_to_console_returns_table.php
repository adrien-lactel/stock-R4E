<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->foreignId('repairer_id')
                ->nullable()
                ->after('store_id')
                ->constrained()
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->dropForeign(['repairer_id']);
            $table->dropColumn('repairer_id');
        });
    }
};
