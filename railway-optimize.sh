#!/bin/bash
# Script d'optimisation pour Railway
# Execute sur Railway après déploiement

echo "🚀 Optimisation Laravel pour Railway..."

# Clear all caches first to ensure fresh start
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
echo "✅ Caches cleared"

# Cache de configuration
php artisan config:cache
echo "✅ Config cached"

# NE PAS cacher les routes - cela empêche les nouvelles routes de fonctionner
# php artisan route:cache

# Cache de views
php artisan view:cache
echo "✅ Views cached"

# Optimisation autoload Composer
composer install --optimize-autoloader --no-dev
echo "✅ Autoloader optimized"

echo "✨ Optimisation terminée!"
