#!/bin/bash

# Script pour nettoyer et réinitialiser la base de données sur Railway

echo "🗑️  Nettoyage et réinitialisation de la base de données Railway..."
echo ""

# Exécuter migrate:fresh (supprime toutes les tables et recrée la structure)
echo "📦 Exécution de migrate:fresh..."
php artisan migrate:fresh --force

# Exécuter le seeder de taxonomie
echo "🎮 Exécution du seeder de taxonomie des consoles..."
php artisan db:seed --class=ConsoleTaxonomySeeder --force

# Exécuter le seeder principal (admin user, etc.)
echo "👤 Exécution du seeder principal..."
php artisan db:seed --force

echo ""
echo "✅ Base de données nettoyée et réinitialisée avec succès !"
echo "   - 419 variantes de consoles créées"
echo "   - 82 modèles de consoles"
echo "   - 8 marques"
echo "   - Utilisateur admin créé"
