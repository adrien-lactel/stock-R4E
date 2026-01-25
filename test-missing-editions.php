<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleType;

// Tester quelques éditions
$editions = ['EV5 - Forces Temporelles', 'EV6 - Destinées de Paldea'];

foreach ($editions as $editionName) {
    $type = ArticleType::whereHas('subCategory', function($q) use ($editionName) {
        $q->where('name', 'like', "%{$editionName}%");
    })->first();
    
    if ($type) {
        echo "✅ {$type->subCategory->name}\n";
        echo $type->description . "\n\n";
    } else {
        echo "❌ {$editionName} - Non trouvée\n\n";
    }
}
