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
        Schema::create('product_sheets', function (Blueprint $table) {
            $table->id();
            
            // Relations
            $table->foreignId('article_type_id')->nullable()->constrained('article_types')->nullOnDelete();
            
            // Informations produit
            $table->string('name'); // Nom de la fiche produit
            $table->text('description')->nullable();
            $table->text('technical_specs')->nullable(); // Caractéristiques techniques
            $table->text('included_items')->nullable(); // Accessoires inclus
            
            // Images
            $table->json('images')->nullable(); // URLs des images sélectionnées
            $table->string('main_image')->nullable(); // Image principale
            
            // SEO & Marketing
            $table->text('marketing_description')->nullable();
            $table->json('tags')->nullable(); // Tags pour recherche
            
            // Statut
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sheets');
    }
};
