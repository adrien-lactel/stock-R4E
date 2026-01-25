<?php

$file = 'database/seeders/ConsoleTaxonomySeeder.php';
$content = file_get_contents($file);

// Mapping des sous-catégories vers leurs descriptions
$descriptions = [
    'cartesNintendoSub' => "Cartes mémoire Nintendo",
    'cartesSonySub' => "Cartes mémoire Sony",
    'cartesSegaSub' => "Cartes mémoire Sega",
    'cartesMicrosoftSub' => "Cartes mémoire Microsoft",
    
    'cablesNintendoSub' => "Câbles Nintendo",
    'cablesSonySub' => "Câbles Sony",
    'cablesMicrosoftSub' => "Câbles Microsoft",
    'cablesSegaSub' => "Câbles Sega",
    'cablesAtariSub' => "Câbles Atari",
    'cablesNECSub' => "Câbles NEC",
    
    'etuisNintendoSub' => "Étuis Nintendo",
    'etuisSonySub' => "Étuis Sony",
    
    'chargeursNintendoSub' => "Chargeurs Nintendo",
    'chargeursSonySub' => "Chargeurs Sony",
    'chargeursMicrosoftSub' => "Chargeurs Microsoft",
    
    'batteriesNintendoSub' => "Batteries Nintendo",
    'batteriesSonySub' => "Batteries Sony",
    'batteriesMicrosoftSub' => "Batteries Microsoft",
    
    'boitesNintendoSub' => "Boîtes collector Nintendo",
    'boitesSonySub' => "Boîtes collector Sony",
    'boitesMicrosoftSub' => "Boîtes collector Microsoft",
    'boitesSegaSub' => "Boîtes collector Sega",
    'boitesNECSub' => "Boîtes collector NEC",
];

// Pattern pour trouver les boucles simples sans description
$pattern = '/(\s+)(foreach \(\$\w+ as \$\w+\) \{)\s+ArticleType::updateOrCreate\(\[\s+\'name\' => \$(\w+),\s+\'article_sub_category_id\' => \$(\w+)->id\s+\]\);/';

// Compter les matchs avant remplacement
preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);
echo "Trouvé " . count($matches) . " boucles sans description\n\n";

// Afficher les sous-catégories trouvées
$found_subs = array_unique(array_column($matches, 4));
echo "Sous-catégories:\n";
foreach ($found_subs as $sub) {
    echo "- $sub\n";
}

// Remplacer chaque occurrence
$content = preg_replace_callback($pattern, function($match) use ($descriptions) {
    $indent = $match[1];
    $foreach_line = $match[2];
    $var_name = $match[3];
    $sub_var = $match[4];
    
    $desc_key = $descriptions[$sub_var] ?? "Accessoire";
    
    // Générer le code de remplacement avec description
    return $indent . "\$description = \$this->generateAccessoryDescription('{$desc_key}', 'compatible');\n" .
           $indent . "\n" .
           $indent . $foreach_line . "\n" .
           $indent . "    ArticleType::updateOrCreate([\n" .
           $indent . "        'name' => \${$var_name},\n" .
           $indent . "        'article_sub_category_id' => \${$sub_var}->id\n" .
           $indent . "    ], [\n" .
           $indent . "        'name' => \${$var_name},\n" .
           $indent . "        'article_sub_category_id' => \${$sub_var}->id,\n" .
           $indent . "        'description' => \$description\n" .
           $indent . "    ]);";
}, $content);

// Sauvegarder
file_put_contents($file, $content);
echo "\n✅ Fichier modifié avec succès!\n";
