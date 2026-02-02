# Import des tables taxonomie et publishers vers Railway
# Usage: .\import-all-tables.ps1 [ExportFolder]

param(
    [string]$ExportFolder = "railway-full-export-2026-02-02_181247"
)

Write-Host "=== Import des tables vers Railway ===" -ForegroundColor Cyan
Write-Host ""

if (-not (Test-Path $ExportFolder)) {
    Write-Host "ERREUR: Dossier $ExportFolder introuvable" -ForegroundColor Red
    exit 1
}

$dbHost = $env:RAILWAY_DB_HOST
$port = $env:RAILWAY_DB_PORT
$user = $env:RAILWAY_DB_USER
$password = $env:RAILWAY_DB_PASSWORD
$database = $env:RAILWAY_DB_NAME

if (-not $dbHost -or -not $user -or -not $database) {
    Write-Host "ERREUR: Variables Railway manquantes" -ForegroundColor Red
    exit 1
}

$mysqlPath = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysql.exe"

if (-not (Test-Path $mysqlPath)) {
    Write-Host "ERREUR: mysql.exe introuvable" -ForegroundColor Red
    exit 1
}

$tables = @(
    "article_brands",
    "article_categories",
    "article_sub_categories",
    "article_types",
    "publishers",
    "migrations"
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
