# Export complet de toutes les tables vers Railway
# Usage: .\export-all-tables.ps1

$timestamp = Get-Date -Format "yyyy-MM-dd_HHmmss"
$exportDir = "railway-full-export-$timestamp"

Write-Host "=== Export complet de la base de donnees ===" -ForegroundColor Cyan
Write-Host "Creation du dossier: $exportDir" -ForegroundColor Yellow
New-Item -ItemType Directory -Path $exportDir -Force | Out-Null

$mysqlPath = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqldump.exe"
$dbUser = "root"
$dbName = "stock_r4e"

if (-not (Test-Path $mysqlPath)) {
    Write-Host "ERREUR: mysqldump.exe introuvable" -ForegroundColor Red
    exit 1
}

# Tables avec données importantes à exporter
$tables = @(
    "article_brands",
    "article_categories", 
    "article_sub_categories",
    "article_types",
    "publishers",
    "migrations"
)

$totalSize = 0

foreach ($table in $tables) {
    Write-Host "Export de $table..." -NoNewline
    
    $outputFile = Join-Path $exportDir "$table.sql"
    
    & $mysqlPath -u $dbUser --single-transaction --quick --lock-tables=false $dbName $table > $outputFile
    
    if ($LASTEXITCODE -eq 0) {
        $size = (Get-Item $outputFile).Length / 1MB
        $totalSize += $size
        Write-Host "  OK $table exporte - $([math]::Round($size, 2)) MB" -ForegroundColor Green
    } else {
        Write-Host "  ERREUR" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "Resume:" -ForegroundColor Cyan
Write-Host "  Total: $([math]::Round($totalSize, 2)) MB" -ForegroundColor Green
Write-Host "  Dossier: $exportDir" -ForegroundColor Yellow
