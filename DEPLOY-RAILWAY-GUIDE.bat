@echo off
REM ========================================================================
REM GUIDE DE DÉPLOIEMENT WONDERSWAN - RAILWAY
REM ========================================================================

echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║          DÉPLOIEMENT WONDERSWAN VERS RAILWAY               ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo ✅ Code poussé vers GitHub (commit cc4d559f)
echo.
echo 📋 ÉTAPES DE DÉPLOIEMENT:
echo.
echo 1. Ouvrir Railway Dashboard
echo    → https://railway.app/
echo.
echo 2. Sélectionner le projet: stock-R4E
echo.
echo 3. Cliquer sur le service: MySQL
echo.
echo 4. Ouvrir l'onglet: Query
echo.
echo 5. Ouvrir le fichier local:
echo    → c:\laragon\www\stock-R4E\deploy-wonderswan-r2-full.sql
echo.
echo 6. Copier TOUT le contenu du fichier
echo.
echo 7. Coller dans Railway Query Editor
echo.
echo 8. Cliquer sur "Run" ▶️
echo.
echo 9. Attendre la fin de l'exécution (environ 10-20 secondes)
echo.
echo 10. Vérifier avec cette requête:
echo     SELECT COUNT(*) FROM wonderswan_games;
echo     → Doit retourner: 340
echo.
echo ╔════════════════════════════════════════════════════════════╗
echo ║                     RÉSULTAT ATTENDU                       ║
echo ╚════════════════════════════════════════════════════════════╝
echo.
echo • 340 jeux dans la base Railway
echo • 117/117 correspondances images (100%%)
echo • 0 doublon
echo.
echo 📝 Documentation complète: WONDERSWAN_DEPLOYMENT.md
echo.
pause
