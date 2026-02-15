Write-Host "=== IMPORT SNES_GAMES VERS RAILWAY ===" -ForegroundColor Cyan
Write-Host ""
Write-Host "Lancement de l'import..." -ForegroundColor Yellow
Write-Host ""

# Lancer le script PHP
& php import-snes-final.php

if ($LASTEXITCODE -eq 0) {
    Write-Host ""
    Write-Host "=====================================================================" -ForegroundColor Green
    Write-Host "✅ IMPORT TERMINÉ AVEC SUCCÈS!" -ForegroundColor Green
    Write-Host "=====================================================================" -ForegroundColor Green
    Write-Host ""
} else {
    Write-Host ""
    Write-Host "❌ ERREUR DURANT L'IMPORT" -ForegroundColor Red
    Write-Host ""
}
