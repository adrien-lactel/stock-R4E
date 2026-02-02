# Import game databases to Railway
# Usage: .\import-railway.ps1

param(
    [string]$ExportFolder = "railway-db-export-2026-02-01_220909"
)

Write-Host "=== Import des bases de donnees vers Railway ===" -ForegroundColor Cyan
Write-Host ""

# Check if folder exists
if (-not (Test-Path $ExportFolder)) {
    Write-Host "ERREUR: Dossier $ExportFolder introuvable" -ForegroundColor Red
    exit 1
}

# Railway connection info (from environment variables)
$dbHost = $env:RAILWAY_DB_HOST
$port = $env:RAILWAY_DB_PORT
$user = $env:RAILWAY_DB_USER
$password = $env:RAILWAY_DB_PASSWORD
$database = $env:RAILWAY_DB_NAME

if (-not $dbHost -or -not $user -or -not $database) {
    Write-Host "ERREUR: Variables d'environnement Railway manquantes" -ForegroundColor Red
    Write-Host ""
    Write-Host "Definissez les variables suivantes:" -ForegroundColor Yellow
    Write-Host '  $env:RAILWAY_DB_HOST = "monorail.proxy.rlwy.net"'
    Write-Host '  $env:RAILWAY_DB_PORT = "12345"'
    Write-Host '  $env:RAILWAY_DB_USER = "root"'
    Write-Host '  $env:RAILWAY_DB_PASSWORD = "votre-password"'
    Write-Host '  $env:RAILWAY_DB_NAME = "railway"'
    Write-Host ""
    Write-Host "Trouvez ces infos dans: Railway Dashboard > Database > Connect" -ForegroundColor Yellow
    exit 1
}

$mysqlPath = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe"

if (-not (Test-Path $mysqlPath)) {
    Write-Host "ERREUR: mysql.exe introuvable: $mysqlPath" -ForegroundColor Red
    exit 1
}

$tables = @(
    "game_boy_games",
    "n64_games",
    "nes_games",
    "snes_games",
    "game_gear_games",
    "wonderswan_games",
    "sega_saturn_games",
    "mega_drive_games",
    "article_brands",
    "article_categories",
    "article_sub_categories",
    "article_types",
    "publishers"
)

Write-Host "Host: $dbHost" -ForegroundColor Green
Write-Host "Database: $database" -ForegroundColor Green
Write-Host ""

foreach ($table in $tables) {
    $sqlFile = Join-Path $ExportFolder "$table.sql"
    
    if (-not (Test-Path $sqlFile)) {
        Write-Host "  SKIP $table - fichier manquant" -ForegroundColor Yellow
        continue
    }
    
    Write-Host "Import de $table..." -NoNewline
    
    $args = @(
        "-h", $dbHost,
        "-P", $port,
        "-u", $user,
        "-p$password",
        $database
    )
    
    try {
        Get-Content $sqlFile | & $mysqlPath @args 2>&1 | Out-Null
        
        if ($LASTEXITCODE -eq 0) {
            Write-Host "  OK" -ForegroundColor Green
        } else {
            Write-Host "  ERREUR (code: $LASTEXITCODE)" -ForegroundColor Red
        }
    } catch {
        Write-Host "  ERREUR: $_" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "Import termine!" -ForegroundColor Cyan
