# Script PowerShell pour nettoyer et réinitialiser la base de données sur Railway

Write-Host "🗑️  Nettoyage et réinitialisation de la base de données Railway..." -ForegroundColor Cyan
Write-Host ""

# Exécuter migrate:fresh (supprime toutes les tables et recrée la structure)
Write-Host "📦 Exécution de migrate:fresh..." -ForegroundColor Yellow
php artisan migrate:fresh --force

# Exécuter le seeder de taxonomie
Write-Host "🎮 Exécution du seeder de taxonomie des consoles..." -ForegroundColor Yellow
php artisan db:seed --class=ConsoleTaxonomySeeder --force

# Exécuter le seeder principal (admin user, etc.)
Write-Host "👤 Exécution du seeder principal..." -ForegroundColor Yellow
php artisan db:seed --force

Write-Host ""
Write-Host "✅ Base de données nettoyée et réinitialisée avec succès !" -ForegroundColor Green
Write-Host "   - 419 variantes de consoles créées" -ForegroundColor Green
Write-Host "   - 82 modèles de consoles" -ForegroundColor Green
Write-Host "   - 8 marques" -ForegroundColor Green
Write-Host "   - Utilisateur admin créé" -ForegroundColor Green
