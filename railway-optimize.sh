#!/bin/bash
# Script d'optimisation pour Railway
# Execute sur Railway après déploiement

echo "🚀 Optimisation Laravel pour Railway..."

# Créer les dossiers storage nécessaires s'ils n'existent pas
mkdir -p storage/framework/{sessions,views,cache}
mkdir -p storage/logs
chmod -R 775 storage
chmod -R 775 bootstrap/cache
echo "✅ Storage directories created"

# Clear all caches first to ensure fresh start (ignorer les erreurs)
php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true
echo "✅ Caches cleared"

# Cache de configuration
php artisan config:cache 2>/dev/null || echo "⚠️ Config cache skipped"
echo "✅ Config cached"

# NE PAS cacher les routes - cela empêche les nouvelles routes de fonctionner
# php artisan route:cache

# NE PAS cacher les views - cela empêche les modifications Blade de fonctionner
# php artisan view:cache

# Optimisation autoload Composer (déjà fait pendant le build)
# composer install --optimize-autoloader --no-dev

echo "✨ Optimisation terminée!"
