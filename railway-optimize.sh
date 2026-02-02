#!/bin/bash
# Script d'optimisation pour Railway
# Execute sur Railway après déploiement

echo "🚀 Optimisation Laravel pour Railway..."

# Cache de configuration
php artisan config:cache
echo "✅ Config cached"

# Cache de routes
php artisan route:cache
echo "✅ Routes cached"

# Cache de views
php artisan view:cache
echo "✅ Views cached"

# Optimisation autoload Composer
composer install --optimize-autoloader --no-dev
echo "✅ Autoloader optimized"

echo "✨ Optimisation terminée!"
