# Script pour démarrer Laragon MySQL et importer snes_games vers Railway

Write-Host "=== IMPORT SNES_GAMES VERS RAILWAY ===" -ForegroundColor Cyan
Write-Host ""

# 1. Vérifier si MySQL est en cours d'exécution
Write-Host "1️⃣ Vérification du service MySQL..." -ForegroundColor Yellow
$mysqlProcess = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue

if ($null -eq $mysqlProcess) {
    Write-Host "   ⚠️ MySQL n'est pas démarré" -ForegroundColor Red
    Write-Host ""
    
    # Chercher Laragon
    $laraGonPaths = @(
        "C:\laragon\laragon.exe",
        "C:\Program Files\Laragon\laragon.exe",
        "C:\Program Files (x86)\Laragon\laragon.exe"
    )
    
    $laraGonExe = $null
    foreach ($path in $laraGonPaths) {
        if (Test-Path $path) {
            $laraGonExe = $path
            break
        }
    }
    
    if ($null -ne $laraGonExe) {
        Write-Host "2️⃣ Démarrage de Laragon..." -ForegroundColor Yellow
        Write-Host "   📂 Chemin: $laraGonExe" -ForegroundColor Gray
        
        # Démarrer Laragon
        Start-Process -FilePath $laraGonExe -WindowStyle Minimized
        
        Write-Host "   ⏳ Attente du démarrage de MySQL (20 secondes)..." -ForegroundColor Gray
        Start-Sleep -Seconds 20
        
        # Vérifier à nouveau
        $mysqlProcess = Get-Process -Name "mysqld" -ErrorAction SilentlyContinue
        
        if ($null -eq $mysqlProcess) {
            Write-Host "   ❌ MySQL ne s'est pas démarré automatiquement" -ForegroundColor Red
            Write-Host ""
            Write-Host "   ACTIONS MANUELLES:" -ForegroundColor Yellow
            Write-Host "   1. Ouvrez Laragon" -ForegroundColor White
            Write-Host "   2. Cliquez sur 'Démarrer tout'" -ForegroundColor White
            Write-Host "   3. Attendez que MySQL démarre" -ForegroundColor White
            Write-Host "   4. Re-exécutez ce script" -ForegroundColor White
            Write-Host ""
            exit 1
        }
    } else {
        Write-Host "   ❌ Laragon introuvable" -ForegroundColor Red
        Write-Host ""
        Write-Host "   ACTIONS MANUELLES:" -ForegroundColor Yellow
        Write-Host "   1. Démarrez MySQL manuellement" -ForegroundColor White
        Write-Host "   2. Re-exécutez ce script" -ForegroundColor White
        Write-Host ""
        exit 1
    }
} else {
    Write-Host "   ✅ MySQL est en cours d'exécution (PID: $($mysqlProcess.Id))" -ForegroundColor Green
}

Write-Host ""
Write-Host "3️⃣ Lancement de l'import..." -ForegroundColor Yellow
Write-Host ""

# Exécuter le script PHP
php import-snes-to-railway.php

$exitCode = $LASTEXITCODE

Write-Host ""
if ($exitCode -eq 0) {
    Write-Host "✅ IMPORT TERMINÉ AVEC SUCCÈS!" -ForegroundColor Green
} else {
    Write-Host "❌ ERREUR DURANT L'IMPORT (code: $exitCode)" -ForegroundColor Red
}

Write-Host ""
