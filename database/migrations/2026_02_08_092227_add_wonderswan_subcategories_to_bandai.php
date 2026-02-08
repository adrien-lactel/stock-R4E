<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\ArticleCategory;
use App\Models\ArticleBrand;
use App\Models\ArticleSubCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Chercher la catégorie "Jeux vidéo"
        $jeuxCategory = ArticleCategory::where('name', 'LIKE', '%jeux vidéo%')
            ->orWhere('name', 'LIKE', '%Jeux vidéo%')
            ->first();

        if (!$jeuxCategory) {
            echo "⚠️ Catégorie 'Jeux vidéo' introuvable, création ignorée.\n";
            return;
        }

        // Chercher ou créer la marque Bandai
        $bandaiBrand = ArticleBrand::firstOrCreate([
            'name' => 'Bandai',
            'article_category_id' => $jeuxCategory->id,
        ]);

        // Créer ou mettre à jour WonderSwan
        ArticleSubCategory::updateOrCreate([
            'name' => 'WonderSwan',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $bandaiBrand->id
        ]);

        // Créer ou mettre à jour WonderSwan Color
        ArticleSubCategory::updateOrCreate([
            'name' => 'WonderSwan Color',
            'article_category_id' => $jeuxCategory->id,
        ], [
            'article_brand_id' => $bandaiBrand->id
        ]);

        echo "✅ Sous-catégories WonderSwan créées/mises à jour dans la marque Bandai\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // On ne supprime pas les sous-catégories en cas de rollback
        // car elles pourraient avoir des types associés
        echo "⚠️ Rollback: Les sous-catégories WonderSwan ne sont pas supprimées par sécurité\n";
    }
};
