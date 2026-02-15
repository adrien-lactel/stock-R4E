<?php

echo "=== TEST API RAILWAY getTaxonomyImages ===\n\n";

$url = 'https://web-production-f3333.up.railway.app/admin/taxonomy/get-images?identifier=SHVC-ADFJ-JPN&folder=snes';

echo "URL testée: {$url}\n\n";

// Faire la requête
$response = file_get_contents($url);

if ($response === false) {
    echo "❌ ERREUR: Impossible de récupérer la réponse\n";
    exit(1);
}

echo "✅ Réponse reçue\n\n";
echo str_repeat('=', 80) . "\n";
echo "RÉPONSE BRUTE:\n";
echo str_repeat('=', 80) . "\n";
echo $response . "\n\n";

// Parser le JSON
$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "❌ ERREUR JSON: " . json_last_error_msg() . "\n";
    exit(1);
}

echo str_repeat('=', 80) . "\n";
echo "ANALYSE:\n";
echo str_repeat('=', 80) . "\n\n";

echo "Success: " . ($data['success'] ? '✅ true' : '❌ false') . "\n";
echo "Total: " . ($data['total'] ?? 0) . "\n";
echo "Nombre d'images: " . count($data['images'] ?? []) . "\n\n";

if (!empty($data['images'])) {
    echo "DÉTAIL DES IMAGES:\n";
    echo str_repeat('-', 80) . "\n";
    
    foreach ($data['images'] as $i => $img) {
        echo "\nImage #" . ($i + 1) . ":\n";
        echo "  • Filename: " . ($img['filename'] ?? 'NULL') . "\n";
        echo "  • Type: " . ($img['type'] ?? 'NULL') . "\n";
        echo "  • Full Type: " . ($img['full_type'] ?? 'NULL') . "\n";
        echo "  • Index: " . ($img['index'] ?? 'NULL') . "\n";
        echo "  • Size: " . ($img['size'] ?? 0) . " bytes\n";
        echo "  • Source: " . ($img['source'] ?? 'NULL') . "\n";
        echo "  • URL: " . ($img['url'] ?? 'NULL') . "\n";
        
        // Tester si l'URL fonctionne
        if (!empty($img['url'])) {
            $headers = @get_headers($img['url']);
            $exists = $headers && strpos($headers[0], '200') !== false;
            echo "  • Test URL: " . ($exists ? '✅ 200 OK' : '❌ ERREUR') . "\n";
        }
    }
} else {
    echo "❌ Aucune image retournée\n";
}

echo "\n" . str_repeat('=', 80) . "\n";
echo "💡 DIAGNOSTIC\n";
echo str_repeat('=', 80) . "\n\n";

if (empty($data['images'])) {
    echo "❌ PROBLÈME: L'API ne retourne aucune image\n";
    echo "   → Les fichiers ne sont pas trouvés sur R2\n";
    echo "   → Vérifier les credentials R2 sur Railway\n";
} else {
    $urlsOk = 0;
    $urlsKo = 0;
    
    foreach ($data['images'] as $img) {
        if (!empty($img['url'])) {
            $headers = @get_headers($img['url']);
            if ($headers && strpos($headers[0], '200') !== false) {
                $urlsOk++;
            } else {
                $urlsKo++;
            }
        }
    }
    
    echo "URLs testées:\n";
    echo "  • ✅ Fonctionnelles: {$urlsOk}\n";
    echo "  • ❌ En erreur: {$urlsKo}\n\n";
    
    if ($urlsKo > 0) {
        echo "❌ PROBLÈME: Certaines URLs ne fonctionnent pas\n";
        echo "   → Les URLs sont générées mais les fichiers ne sont pas accessibles\n";
    } else {
        echo "✅ Toutes les URLs fonctionnent!\n";
        echo "   → Le problème est probablement côté JavaScript\n";
    }
}
