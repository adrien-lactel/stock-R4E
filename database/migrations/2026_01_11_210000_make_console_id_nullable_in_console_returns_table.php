<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->unsignedBigInteger('console_id')->nullable()->change();
            
            // Champs pour articles externes (hors stock)
            $table->string('external_item_name')->nullable()->after('console_id');
            $table->text('external_item_description')->nullable()->after('external_item_name');
            $table->boolean('is_external')->default(false)->after('console_id');
        });
    }

    public function down(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->dropColumn(['external_item_name', 'external_item_description', 'is_external']);
            // Note: reverting nullable to required needs data cleanup
        });
    }
};
