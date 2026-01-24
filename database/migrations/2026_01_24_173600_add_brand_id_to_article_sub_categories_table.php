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
        Schema::table('article_sub_categories', function (Blueprint $table) {
            $table->foreignId('article_brand_id')->nullable()->after('article_category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('article_sub_categories', function (Blueprint $table) {
            $table->dropForeign(['article_brand_id']);
            $table->dropColumn('article_brand_id');
        });
    }
};
