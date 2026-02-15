$path = "C:\laragon\www\stock-R4E\public\images\taxonomy\snes"

$files = Get-ChildItem -Path $path -Filter "*.png" -File

$covers = ($files | Where-Object { $_.Name -match '-cover(-\d+)?\.png$' }).Count
$artworks = ($files | Where-Object { $_.Name -match '-artwork\.png$' }).Count
$logos = ($files | Where-Object { $_.Name -match '-logo\.png$' }).Count
$gameplay = ($files | Where-Object { $_.Name -match '-gameplay\.png$' }).Count
$cover2 = ($files | Where-Object { $_.Name -match '-cover-2\.png$' }).Count

$total = $files.Count

Write-Host "=== IMAGES SNES EN LOCAL ===" -ForegroundColor Cyan
Write-Host ""
Write-Host "Total d'images PNG: $total" -ForegroundColor Green
Write-Host ""
Write-Host "Repartition par type:" -ForegroundColor Yellow
Write-Host "  Covers (principale): $($covers - $cover2)"
Write-Host "  Covers (alternative -2): $cover2"
Write-Host "  Artworks: $artworks"
Write-Host "  Logos: $logos"
Write-Host "  Gameplay: $gameplay"
Write-Host ""

# Compter ROM IDs uniques
$romIds = @{}
foreach ($file in $files) {
    if ($file.Name -match '^([A-Z0-9\-]+?)-(cover|artwork|logo|gameplay)(-\d+)?\.png$') {
        $romId = $matches[1]
        if (-not $romIds.ContainsKey($romId)) {
            $romIds[$romId] = 0
        }
        $romIds[$romId]++
    }
}

Write-Host "ROM IDs uniques avec images: $($romIds.Count)" -ForegroundColor Green
Write-Host ""
Write-Host "=== COMPARAISON LOCAL vs R2 ===" -ForegroundColor Cyan
Write-Host ""
Write-Host "EN LOCAL:"
Write-Host "  Total images: $total"
Write-Host "  ROM IDs: $($romIds.Count)"
Write-Host ""
Write-Host "SUR R2 (derniere verification):"
Write-Host "  Total images: 749"
Write-Host "  ROM IDs: 495"
Write-Host ""
$diffImages = $total - 749
$diffRoms = $romIds.Count - 495
Write-Host "DIFFERENCE:" -ForegroundColor Yellow
Write-Host "  Images supplementaires en local: +$diffImages" -ForegroundColor Yellow
Write-Host "  ROM IDs supplementaires en local: +$diffRoms" -ForegroundColor Yellow
