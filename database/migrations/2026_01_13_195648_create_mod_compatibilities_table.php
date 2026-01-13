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
        Schema::create('mod_compatibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mod_id')->constrained()->onDelete('cascade');
            
            // Compatibilité avec la taxonomie (nullable car on peut spécifier à différents niveaux)
            $table->foreignId('article_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('article_sub_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('article_type_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->timestamps();
            
            // Index pour performance
            $table->index(['mod_id', 'article_type_id']);
            $table->index(['mod_id', 'article_sub_category_id']);
            $table->index(['mod_id', 'article_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mod_compatibilities');
    }
};
