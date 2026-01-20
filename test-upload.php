<?php
// Script de test pour diagnostiquer le problème d'upload

echo "Test d'upload d'image\n\n";

// Vérifier que le dossier existe
$dir = __DIR__ . '/storage/app/public/product-sheets';
echo "Dossier de destination: $dir\n";
echo "Existe: " . (is_dir($dir) ? 'Oui' : 'Non') . "\n";
echo "Writable: " . (is_writable($dir) ? 'Oui' : 'Non') . "\n\n";

// Vérifier la configuration
echo "Configuration filesystem:\n";
echo "Default disk: " . config('filesystems.default') . "\n";
echo "Public disk root: " . config('filesystems.disks.public.root') . "\n";
echo "Public disk URL: " . config('filesystems.disks.public.url') . "\n\n";

// Vérifier le lien symbolique
$link = __DIR__ . '/public/storage';
echo "Lien symbolique: $link\n";
echo "Existe: " . (file_exists($link) ? 'Oui' : 'Non') . "\n";
echo "Est un lien: " . (is_link($link) ? 'Oui' : 'Non') . "\n";

if (is_link($link)) {
    echo "Pointe vers: " . readlink($link) . "\n";
}
