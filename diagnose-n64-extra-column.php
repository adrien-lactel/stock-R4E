<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         DIAGNOSTIC N64 - COLONNE SUPPLÉMENTAIRE                    ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$referenceColumns = [
    'id', 'rom_id', 'cartridge_id', 'name', 'name_jp', 'alternate_names',
    'year', 'publisher', 'developer', 'region', 'slug', 'image_url',
    'image_path', 'cloudinary_url', 'libretro_name', 'match_type',
    'match_score', 'source', 'price', 'created_at', 'updated_at'
];

$n64Columns = DB::select("SHOW COLUMNS FROM n64_games");
$n64ColumnNames = array_map(fn($col) => $col->Field, $n64Columns);

echo "📋 Colonnes de n64_games (" . count($n64ColumnNames) . "):\n";
foreach ($n64ColumnNames as $i => $col) {
    echo sprintf("   %2d. %s\n", $i + 1, $col);
}

echo "\n═══════════════════════════════════════════════════════════════════════\n";
echo "🔍 COMPARAISON AVEC LE SCHÉMA DE RÉFÉRENCE\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

// Colonnes dans n64 mais pas dans référence
$extra = array_diff($n64ColumnNames, $referenceColumns);

if (!empty($extra)) {
    echo "❌ Colonnes EN TROP dans n64_games:\n";
    foreach ($extra as $col) {
        echo "   • {$col}\n";
        
        // Vérifier si elle contient des données
        $notEmpty = DB::table('n64_games')->whereNotNull($col)->where($col, '!=', '')->count();
        $total = DB::table('n64_games')->count();
        
        echo "     Remplie: {$notEmpty}/{$total} jeux (" . 
             ($total > 0 ? round(($notEmpty / $total) * 100, 1) : 0) . "%)\n";
        
        // Échantillon de valeurs
        if ($notEmpty > 0) {
            $samples = DB::table('n64_games')
                ->whereNotNull($col)
                ->where($col, '!=', '')
                ->limit(3)
                ->pluck($col);
            echo "     Exemples: " . implode(', ', $samples->toArray()) . "\n";
        }
    }
    echo "\n";
}

// Colonnes dans référence mais pas dans n64
$missing = array_diff($referenceColumns, $n64ColumnNames);

if (!empty($missing)) {
    echo "⚠️  Colonnes MANQUANTES dans n64_games:\n";
    foreach ($missing as $col) {
        echo "   • {$col}\n";
    }
    echo "\n";
}

echo "═══════════════════════════════════════════════════════════════════════\n";
echo "💡 RECOMMANDATION:\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

if (!empty($extra)) {
    foreach ($extra as $col) {
        $notEmpty = DB::table('n64_games')->whereNotNull($col)->where($col, '!=', '')->count();
        
        if ($notEmpty === 0) {
            echo "✓ Supprimer la colonne '{$col}' (aucune donnée)\n";
            echo "  SQL: ALTER TABLE n64_games DROP COLUMN `{$col}`;\n\n";
        } else {
            echo "⚠️  La colonne '{$col}' contient des données ({$notEmpty} jeux)\n";
            echo "   Options:\n";
            echo "   1. Conserver si données importantes\n";
            echo "   2. Migrer vers une colonne standard si équivalent existe\n";
            echo "   3. Supprimer si données non critiques\n\n";
        }
    }
}
