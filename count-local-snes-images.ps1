$snesPath = "C:\laragon\www\stock-R4E\public\images\taxonomy\snes"

Write-Host "=== IMAGES SNES EN LOCAL ===" -ForegroundColor Cyan
Write-Host ""

if (-not (Test-Path $snesPath)) {
    Write-Host "❌ Dossier introuvable: $snesPath" -ForegroundColor Red
    exit 1
}

$files = Get-ChildItem -Path $snesPath -Filter "*.png" -File
$total = $files.Count

Write-Host "📂 Chemin: $snesPath" -ForegroundColor White
Write-Host "📊 Total d'images PNG: $total" -ForegroundColor Green
Write-Host ""

# Compter par type
$covers = ($files | Where-Object { $_.Name -like "*-cover.png" }).Count
$logos = ($files | Where-Object { $_.Name -like "*-logo.png" }).Count
$artworks = ($files | Where-Object { $_.Name -like "*-artwork.png" }).Count
$gameplay = ($files | Where-Object { $_.Name -like "*-gameplay.png" }).Count

Write-Host "Répartition par type:" -ForegroundColor Yellow
Write-Host "  - Covers: $covers"
Write-Host "  - Logos: $logos"
Write-Host "  - Artworks: $artworks"
Write-Host "  - Gameplay: $gameplay"
Write-Host ""

# Compter les ROM IDs uniques
$romIds = @{}
foreach ($file in $files) {
    if ($file.Name -match '^([A-Z0-9\-]+)-(cover|logo|artwork|gameplay)\.png$') {
        $romId = $matches[1]
        $type = $matches[2]
        
        if (-not $romIds.ContainsKey($romId)) {
            $romIds[$romId] = @()
        }
        $romIds[$romId] += $type
    }
}

$uniqueRoms = $romIds.Count
Write-Host "ROM IDs uniques: $uniqueRoms" -ForegroundColor Green
Write-Host ""

Write-Host "Exemples - 10 premiers ROM IDs avec leurs types:" -ForegroundColor Yellow
$romIds.GetEnumerator() | Select-Object -First 10 | ForEach-Object {
    $types = $_.Value -join ', '
    Write-Host "  • $($_.Key): $types"
}

Write-Host ""
Write-Host "=" * 70
Write-Host "📊 COMPARAISON LOCAL vs R2"
Write-Host "=" * 70
Write-Host ""
Write-Host "EN LOCAL:"
Write-Host "  • Total d'images: $total"
Write-Host "  • ROM IDs uniques: $uniqueRoms"
Write-Host ""
Write-Host "SUR R2 (d'après la dernière vérification):"
Write-Host "  • Total d'images: 749 (495 covers + 254 artworks)"
Write-Host "  • ROM IDs uniques: 495"
Write-Host ""
Write-Host "💡 DIFFÉRENCE:"
$diff = $total - 749
$diffRoms = $uniqueRoms - 495
Write-Host "  • $diff images supplémentaires en local" -ForegroundColor Yellow
Write-Host "  • $diffRoms ROM IDs supplémentaires en local" -ForegroundColor Yellow
Write-Host ""

if ($diff -gt 0) {
    Write-Host "⚠️ Le dossier local contient PLUS d'images que R2!" -ForegroundColor Yellow
    Write-Host "   → Envisagez de synchroniser les images locales vers R2" -ForegroundColor White
}
