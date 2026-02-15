<?php

echo "=== VÉRIFICATION ARTICLE 1457 - TAXONOMIE ===\n\n";

$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

try {
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 30]
    );
    
    // Récupérer l'article
    $stmt = $pdo->prepare("
        SELECT c.*,
               cat.name as category_name,
               sub.name as subcategory_name,
               type.name as type_name
        FROM consoles c
        LEFT JOIN article_categories cat ON c.article_category_id = cat.id
        LEFT JOIN article_sub_categories sub ON c.article_sub_category_id = sub.id
        LEFT JOIN article_types type ON c.article_type_id = type.id
        WHERE c.id = 1457
    ");
    $stmt->execute();
    $console = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($console) {
        echo "Article #1457:\n";
        echo "  • ROM ID: " . ($console['rom_id'] ?? 'NULL') . "\n";
        echo "  • Nom: " . ($console['nom'] ?? 'NULL') . "\n";
        echo "  • Catégorie: " . ($console['category_name'] ?? 'NULL') . "\n";
        echo "  • Sous-catégorie: " . ($console['subcategory_name'] ?? 'NULL') . "\n";
        echo "  • Type: " . ($console['type_name'] ?? 'NULL') . "\n\n";
        
        // Simuler la logique du modal
        echo "📂 SIMULATION LOGIQUE MODAL:\n";
        echo str_repeat('=', 80) . "\n\n";
        
        $romId = $console['rom_id'];
        $subCategoryName = $console['subcategory_name'];
        $categoryName = $console['category_name'];
        
        // Logique actuelle (INCORRECTE)
        $folderActuel = 'other';
        if ($subCategoryName) {
            $folderActuel = strtolower(preg_replace('/\s+/', '', $subCategoryName));
        } elseif ($categoryName) {
            $folderActuel = strtolower(preg_replace('/\s+/', '', $categoryName));
        }
        
        echo "LOGIQUE ACTUELLE:\n";
        echo "  • SubCategory: {$subCategoryName}\n";
        echo "  • Folder calculé: {$folderActuel}\n";
        echo "  • Chemin cherché: taxonomy/{$folderActuel}/{$romId}-cover.png\n";
        echo "  • URL R2 cherchée: https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folderActuel}/{$romId}-cover.png\n\n";
        
        // Logique correcte (avec mapping)
        $platformMapping = [
            'Super Nintendo' => 'snes',
            'Game Boy' => 'gameboy',
            'Game Boy Color' => 'game boy color',
            'Game Boy Advance' => 'game boy advance',
            'Nintendo 64' => 'n64',
            'Nintendo Entertainment System' => 'nes',
            'WonderSwan' => 'wonderswan color',
            'WonderSwan Color' => 'wonderswan color',
            'Mega Drive' => 'megadrive',
            'Sega Saturn' => 'segasaturn',
            'Game Gear' => 'gamegear',
        ];
        
        $folderCorrect = $platformMapping[$subCategoryName] ?? $folderActuel;
        
        echo "LOGIQUE CORRIGÉE:\n";
        echo "  • SubCategory: {$subCategoryName}\n";
        echo "  • Folder mappé: {$folderCorrect}\n";
        echo "  • Chemin correct: taxonomy/{$folderCorrect}/{$romId}-cover.png\n";
        echo "  • URL R2 correcte: https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folderCorrect}/{$romId}-cover.png\n\n";
        
        // Vérifier les URLs
        echo "🔍 VÉRIFICATION URLS:\n";
        echo str_repeat('=', 80) . "\n\n";
        
        $urlIncorrecte = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folderActuel}/{$romId}-cover.png";
        $urlCorrecte = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folderCorrect}/{$romId}-cover.png";
        
        echo "URL INCORRECTE (actuelle):\n";
        echo "  {$urlIncorrecte}\n";
        $headersIncorrecte = @get_headers($urlIncorrecte);
        $existsIncorrecte = $headersIncorrecte && strpos($headersIncorrecte[0], '200') !== false;
        echo "  Résultat: " . ($existsIncorrecte ? '✅ 200 OK' : '❌ 404 NOT FOUND') . "\n\n";
        
        echo "URL CORRECTE (avec mapping):\n";
        echo "  {$urlCorrecte}\n";
        $headersCorrecte = @get_headers($urlCorrecte);
        $existsCorrecte = $headersCorrecte && strpos($headersCorrecte[0], '200') !== false;
        echo "  Résultat: " . ($existsCorrecte ? '✅ 200 OK' : '❌ 404 NOT FOUND') . "\n\n";
        
        // Diagnostic
        echo str_repeat('=', 80) . "\n";
        echo "💡 DIAGNOSTIC\n";
        echo str_repeat('=', 80) . "\n\n";
        
        if ($folderActuel !== $folderCorrect) {
            echo "❌ PROBLÈME IDENTIFIÉ!\n\n";
            echo "La fonction openTaxonomyImageEditorModal() utilise:\n";
            echo "  folder = subCategoryName.toLowerCase().replace(/\\s+/g, '')\n\n";
            echo "Cela transforme:\n";
            echo "  '{$subCategoryName}' → '{$folderActuel}'\n\n";
            echo "Mais le bon dossier R2 est:\n";
            echo "  '{$folderCorrect}'\n\n";
            echo "SOLUTION:\n";
            echo "  Ajouter un mapping platformFolders dans openTaxonomyImageEditorModal()\n";
            echo "  similaire à celui dans getGameImageWithFallback()\n\n";
        } else {
            echo "✅ Le mapping est correct\n";
        }
        
    } else {
        echo "❌ Article #1457 non trouvé\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
}
