# Script d'export des bases de jeux pour Railway
$timestamp = Get-Date -Format "yyyy-MM-dd_HHmmss"
$exportDir = "railway-db-export-$timestamp"

Write-Host "Export des bases de donnees de jeux pour Railway" -ForegroundColor Green
Write-Host "Creation du dossier: $exportDir" -ForegroundColor Cyan

New-Item -ItemType Directory -Path $exportDir -Force | Out-Null

$tables = @(
    "game_boy_games",
    "n64_games",
    "nes_games",
    "snes_games",
    "game_gear_games",
    "wonderswan_games",
    "sega_saturn_games",
    "mega_drive_games"
)

$mysqlPath = "C:\laragon\bin\mysql\mysql-8.4.3-winx64\bin\mysqldump.exe"
$dbName = "stock_r4e"
$dbUser = "root"

foreach ($table in $tables) {
    Write-Host "Export de $table..." -ForegroundColor Yellow
    
    $outputFile = "$exportDir\$table.sql"
    
    & $mysqlPath -u $dbUser --single-transaction --quick --lock-tables=false --default-character-set=utf8mb4 --result-file="$outputFile" $dbName $table
    
    if ($LASTEXITCODE -eq 0) {
        $size = (Get-Item $outputFile).Length / 1MB
        Write-Host "  OK $table exporte - $([math]::Round($size, 2)) MB" -ForegroundColor Green
    } else {
        Write-Host "  ERREUR lors de l'export de $table" -ForegroundColor Red
    }
}

Write-Host ""
Write-Host "Resume:" -ForegroundColor Cyan
$totalSize = (Get-ChildItem $exportDir -File | Measure-Object -Property Length -Sum).Sum / 1MB
Write-Host "  Total: $([math]::Round($totalSize, 2)) MB" -ForegroundColor White
Write-Host "  Dossier: $exportDir" -ForegroundColor White
