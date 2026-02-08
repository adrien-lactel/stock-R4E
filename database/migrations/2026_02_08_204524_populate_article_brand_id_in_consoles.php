<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Console;
use App\Models\ArticleSubCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Récupérer toutes les consoles avec article_brand_id manquant mais qui ont une subcategory
        $consoles = Console::whereNull('article_brand_id')
            ->whereNotNull('article_sub_category_id')
            ->get();

        $updated = 0;

        foreach ($consoles as $console) {
            // Récupérer la marque via la sous-catégorie
            $subCategory = ArticleSubCategory::find($console->article_sub_category_id);
            
            if ($subCategory && $subCategory->article_brand_id) {
                $console->article_brand_id = $subCategory->article_brand_id;
                $console->save();
                $updated++;
            }
        }

        echo "✅ {$updated} console(s) mise(s) à jour avec article_brand_id via leur sous-catégorie\n";
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pas de rollback nécessaire - on ne peut pas savoir quelles valeurs étaient correctes avant
        echo "⚠️ Rollback non applicable - impossible de retrouver les valeurs null d'origine\n";
    }
};
