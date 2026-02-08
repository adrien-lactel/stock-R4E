<?php

// Test proxy route avec différents noms de fichiers

$testUrls = [
    'http://stock-r4e.test/proxy/images/taxonomy/gamegear/Sonic Blast (World)-cover.png',
    'http://stock-r4e.test/proxy/images/taxonomy/wonderswan color/Final Lap 2000 (Japan)-cover.png',
];

foreach ($testUrls as $url) {
    echo "\n=== Test: " . basename($url) . " ===\n";
    echo "URL: $url\n";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    echo "Status: $httpCode\n";
    
    if ($httpCode == 301 || $httpCode == 302) {
        preg_match('/Location: (.+)/', $response, $matches);
        if (isset($matches[1])) {
            echo "✅ Redirige vers: " . trim($matches[1]) . "\n";
        }
    } elseif ($httpCode == 404) {
        echo "❌ 404 - Route ou fichier non trouvé\n";
    } elseif ($httpCode == 200) {
        echo "✅ 200 - Image servie localement\n";
    }
}

echo "\n";
