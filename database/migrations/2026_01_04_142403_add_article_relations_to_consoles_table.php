<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consoles', function (Blueprint $table) {

            $table->foreignId('article_category_id')
                ->nullable()
                ->after('id')
                ->constrained('article_categories')
                ->nullOnDelete();

            $table->foreignId('article_sub_category_id')
                ->nullable()
                ->after('article_category_id')
                ->constrained('article_sub_categories')
                ->nullOnDelete();

            $table->foreignId('article_type_id')
                ->nullable()
                ->after('article_sub_category_id')
                ->constrained('article_types')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropForeign(['article_category_id']);
            $table->dropForeign(['article_sub_category_id']);
            $table->dropForeign(['article_type_id']);

            $table->dropColumn([
                'article_category_id',
                'article_sub_category_id',
                'article_type_id',
            ]);
        });
    }
};
