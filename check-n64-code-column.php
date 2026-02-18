<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$codeCount = DB::table('n64_games')->whereNotNull('code')->where('code', '!=', '')->count();
$cartridgeCount = DB::table('n64_games')->whereNotNull('cartridge_id')->where('cartridge_id', '!=', '')->count();

echo "code rempli: {$codeCount}/818\n";
echo "cartridge_id rempli: {$cartridgeCount}/818\n\n";

$samples = DB::table('n64_games')->whereNotNull('code')->limit(5)->get(['code', 'cartridge_id', 'name']);

echo "Échantillon:\n";
foreach ($samples as $row) {
    echo "  • code: " . ($row->code ?? 'NULL') . " | cartridge_id: " . ($row->cartridge_id ?? 'NULL') . " | name: {$row->name}\n";
}

echo "\n💡 CONCLUSION:\n";
if ($cartridgeCount === 0) {
    echo "➜ cartridge_id est vide, on doit copier code → cartridge_id\n";
    echo "➜ Puis supprimer la colonne 'code'\n";
} else {
    echo "➜ cartridge_id contient déjà des données\n";
}
