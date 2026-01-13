<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('repair_quotes', function (Blueprint $table) {
            $table->unsignedBigInteger('console_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('repair_quotes', function (Blueprint $table) {
            // Note: reverting nullable requires data cleanup
            $table->unsignedBigInteger('console_id')->nullable(false)->change();
        });
    }
};
