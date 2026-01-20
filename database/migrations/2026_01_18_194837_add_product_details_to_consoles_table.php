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
            $table->string('cover_image')->nullable()->after('product_page_url');
            $table->string('gameplay_image')->nullable()->after('cover_image');
            $table->text('description')->nullable()->after('gameplay_image');
            $table->text('key_features')->nullable()->after('description');
            $table->decimal('average_market_price', 10, 2)->nullable()->after('key_features');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn(['cover_image', 'gameplay_image', 'description', 'key_features', 'average_market_price']);
        });
    }
};
