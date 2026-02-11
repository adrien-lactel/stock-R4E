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
            if (!Schema::hasColumn('consoles', 'article_images')) {
                $table->json('article_images')->nullable()->after('article_type_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            if (Schema::hasColumn('consoles', 'article_images')) {
                $table->dropColumn('article_images');
            }
        });
    }
};
