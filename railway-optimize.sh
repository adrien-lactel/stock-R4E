#!/bin/bash
# Script d'optimisation pour Railway
# Execute sur Railway après déploiement

echo "🚀 Optimisation Laravel pour Railway..."

# Créer les dossiers storage nécessaires s'ils n'existent pas
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
echo "✅ Storage directories created"

# Clear all caches first to ensure fresh start
php artisan config:clear
php artisan route:clear
php artisan cache:clear
echo "✅ Caches cleared"

# Cache de configuration
php artisan config:cache
echo "✅ Config cached"

# NE PAS cacher les routes - cela empêche les nouvelles routes de fonctionner
# php artisan route:cache

# NE PAS cacher les views - cela empêche les modifications Blade de fonctionner
# php artisan view:cache

# Optimisation autoload Composer
composer install --optimize-autoloader --no-dev
echo "✅ Autoloader optimized"

echo "✨ Optimisation terminée!"
