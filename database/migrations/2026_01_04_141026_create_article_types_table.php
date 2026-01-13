<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('article_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('article_sub_category_id')
                ->constrained('article_sub_categories')
                ->cascadeOnDelete();

            $table->string('name'); // Game Boy, Game Gear, NES, etc.

            $table->timestamps();

            $table->unique(['article_sub_category_id', 'name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_types');
    }
};
