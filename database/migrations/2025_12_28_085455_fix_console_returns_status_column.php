<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->string('status', 20)->default('pending')->change();
        });
    }

    public function down(): void
    {
        // rollback volontairement vide (optionnel)
    }
};
