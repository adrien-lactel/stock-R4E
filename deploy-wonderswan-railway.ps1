#!/usr/bin/env pwsh
# ========================================================================
# SCRIPT DE DÉPLOIEMENT WONDERSWAN - RAILWAY/R2
# Date: 2026-02-18
# ========================================================================

Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║     DÉPLOIEMENT WONDERSWAN VERS RAILWAY/R2 PRODUCTION      ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""

# Vérifier que le fichier SQL existe
if (-not (Test-Path "deploy-wonderswan-r2.sql")) {
    Write-Host "❌ Fichier deploy-wonderswan-r2.sql introuvable!" -ForegroundColor Red
    exit 1
}

Write-Host "📋 Récapitulatif des modifications:" -ForegroundColor Yellow
Write-Host "   • Suppression de 36 doublons" -ForegroundColor White
Write-Host "   • Normalisation de 245 noms de jeux" -ForegroundColor White
Write-Host "   • Ajout 'for WonderSwan' à 85 titres officiels" -ForegroundColor White
Write-Host "   • Ajout de 40 jeux manquants (versions Rev X)" -ForegroundColor White
Write-Host "   • Corrections de caractères (& → _)" -ForegroundColor White
Write-Host ""
Write-Host "📊 Résultat attendu:" -ForegroundColor Yellow
Write-Host "   • Base finale: 340 jeux" -ForegroundColor White
Write-Host "   • Correspondance: 117/117 (100%)" -ForegroundColor White
Write-Host ""

# Demander confirmation
$response = Read-Host "⚠️  Voulez-vous déployer sur Railway/R2? (oui/non)"
if ($response -ne "oui") {
    Write-Host "❌ Déploiement annulé." -ForegroundColor Red
    exit 0
}

Write-Host ""
Write-Host "🚀 Connexion à Railway..." -ForegroundColor Cyan

# Vérifier si Railway CLI est installé
if (-not (Get-Command railway -ErrorAction SilentlyContinue)) {
    Write-Host "❌ Railway CLI n'est pas installé!" -ForegroundColor Red
    Write-Host "💡 Installez-le avec: npm install -g @railway/cli" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "📝 Déploiement manuel:" -ForegroundColor Yellow
    Write-Host "   1. Connectez-vous à Railway: https://railway.app/" -ForegroundColor White
    Write-Host "   2. Accédez à votre base de données MySQL" -ForegroundColor White
    Write-Host "   3. Ouvrez un terminal SQL" -ForegroundColor White
    Write-Host "   4. Copiez/collez le contenu de deploy-wonderswan-r2.sql" -ForegroundColor White
    Write-Host "   5. Exécutez le script" -ForegroundColor White
    exit 1
}

# Obtenir les infos de connexion Railway
Write-Host "📡 Récupération des variables d'environnement..." -ForegroundColor Cyan
$dbHost = railway variables get DB_HOST
$dbPort = railway variables get DB_PORT
$dbName = railway variables get DB_DATABASE
$dbUser = railway variables get DB_USERNAME
$dbPass = railway variables get DB_PASSWORD

if (-not $dbHost) {
    Write-Host "❌ Impossible de récupérer les infos Railway!" -ForegroundColor Red
    Write-Host "💡 Assurez-vous d'être connecté: railway login" -ForegroundColor Yellow
    exit 1
}

Write-Host "✅ Connexion établie: $dbHost" -ForegroundColor Green
Write-Host ""

# Exécuter le SQL
Write-Host "⚙️  Exécution du script SQL..." -ForegroundColor Cyan
Write-Host "   (Cela peut prendre 1-2 minutes)" -ForegroundColor Gray
Write-Host ""

# Utiliser mysql CLI si disponible
if (Get-Command mysql -ErrorAction SilentlyContinue) {
    mysql -h $dbHost -P $dbPort -u $dbUser -p$dbPass $dbName < deploy-wonderswan-r2.sql
    
    if ($LASTEXITCODE -eq 0) {
        Write-Host "✅ DÉPLOIEMENT RÉUSSI!" -ForegroundColor Green
        Write-Host ""
        
        # Vérifier le résultat
        Write-Host "🔍 Vérification..." -ForegroundColor Cyan
        $count = mysql -h $dbHost -P $dbPort -u $dbUser -p$dbPass $dbName -e "SELECT COUNT(*) FROM wonderswan_games;" | Select-Object -Skip 1
        Write-Host "   Total: $count jeux" -ForegroundColor White
        
        if ($count -eq 340) {
            Write-Host "   ✅ Nombre correct!" -ForegroundColor Green
        } else {
            Write-Host "   ⚠️  Nombre inattendu (attendu: 340)" -ForegroundColor Yellow
        }
    } else {
        Write-Host "❌ ERREUR lors du déploiement!" -ForegroundColor Red
        Write-Host "   Consultez les messages d'erreur ci-dessus" -ForegroundColor Yellow
        exit 1
    }
} else {
    Write-Host "⚠️  MySQL CLI non trouvé." -ForegroundColor Yellow
    Write-Host "💡 Utilisez Railway Dashboard ou phpMyAdmin:" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "   Copiez deploy-wonderswan-r2.sql dans Railway Query Editor" -ForegroundColor White
}

Write-Host ""
Write-Host "╔════════════════════════════════════════════════════════════╗" -ForegroundColor Cyan
Write-Host "║                   DÉPLOIEMENT TERMINÉ                      ║" -ForegroundColor Cyan
Write-Host "╚════════════════════════════════════════════════════════════╝" -ForegroundColor Cyan
Write-Host ""
Write-Host "📝 Prochaines étapes:" -ForegroundColor Yellow
Write-Host "   1. Vérifiez les images sur R2: public/images/taxonomy/wonderswan" -ForegroundColor White
Write-Host "   2. Testez l'affichage sur le site de production" -ForegroundColor White
Write-Host "   3. Vérifiez la correspondance 100%" -ForegroundColor White
Write-Host ""
