<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$sheet = App\Models\ProductSheet::first();

if ($sheet) {
    echo "ID: {$sheet->id}\n";
    echo "Nom: {$sheet->name}\n";
    echo "condition_criteria: " . json_encode($sheet->condition_criteria) . "\n";
    echo "condition_criteria_labels: " . json_encode($sheet->condition_criteria_labels) . "\n";
    echo "\n";
    echo "Valeur brute condition_criteria: " . $sheet->getAttributes()['condition_criteria'] . "\n";
    echo "Valeur brute condition_criteria_labels: " . ($sheet->getAttributes()['condition_criteria_labels'] ?? 'NULL') . "\n";
} else {
    echo "Aucune ProductSheet trouvée\n";
}
