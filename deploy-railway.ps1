# Script de deploiement Railway pour Stock R4E avec R2

Write-Host "Preparation du deploiement Railway avec Cloudflare R2" -ForegroundColor Cyan

# 1. Verifier que le mapping R2 existe
if (-Not (Test-Path "storage/app/taxonomy-r2-mapping.json")) {
    Write-Host "ERREUR: Le fichier taxonomy-r2-mapping.json est manquant !" -ForegroundColor Red
    Write-Host "Executez d'abord: php artisan taxonomy:upload-to-r2" -ForegroundColor Yellow
    exit 1
}

# 2. Verifier le nombre d'images dans le mapping
$mapping = Get-Content "storage/app/taxonomy-r2-mapping.json" | ConvertFrom-Json
$imageCount = ($mapping.PSObject.Properties | ForEach-Object { $_.Value.PSObject.Properties.Count } | Measure-Object -Sum).Sum
Write-Host "Mapping R2 trouve: $imageCount images" -ForegroundColor Green

# 3. Copier le mapping dans public/storage/app
New-Item -ItemType Directory -Force -Path "public/storage/app" | Out-Null
Copy-Item "storage/app/taxonomy-r2-mapping.json" "public/storage/app/taxonomy-r2-mapping.json"
Write-Host "Mapping copie dans public/storage/app/" -ForegroundColor Green

# 4. Verifier les variables d'environnement R2
if (-Not $env:R2_ACCESS_KEY_ID -or -Not $env:R2_SECRET_ACCESS_KEY) {
    Write-Host "ATTENTION: Les variables R2 doivent etre configurees dans Railway Dashboard" -ForegroundColor Yellow
}

# 5. Ajouter les fichiers au Git
git add storage/app/taxonomy-r2-mapping.json
git add public/storage/app/taxonomy-r2-mapping.json
git add .gitignore
git add railway.json
git add .env.railway.example
git add deploy-railway.sh
git add deploy-railway.ps1

Write-Host ""
Write-Host "Pret pour le deploiement Railway !" -ForegroundColor Green
Write-Host ""
Write-Host "Prochaines etapes :" -ForegroundColor Cyan
Write-Host "1. Commit: git commit -m 'Add R2 configuration for Railway'" -ForegroundColor White
Write-Host "2. Push: git push origin main" -ForegroundColor White
Write-Host "3. Railway deploiera automatiquement" -ForegroundColor White
Write-Host "4. Configurer les variables R2 dans Railway Dashboard" -ForegroundColor White
Write-Host ""
Write-Host "Les images seront chargees depuis R2" -ForegroundColor Magenta
