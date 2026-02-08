$source = "public/images/taxonomy/wonderswan"
$dest = "public/images/taxonomy/wonderswan color"

# Créer le dossier destination s'il n'existe pas
if (!(Test-Path $dest)) {
    New-Item -ItemType Directory -Path $dest -Force | Out-Null
}

$files = Get-ChildItem $source -File -Filter "*.png"
$total = $files.Count
$processed = 0

Write-Host "Migration des images WonderSwan" -ForegroundColor Cyan
Write-Host "================================" -ForegroundColor Cyan
Write-Host ""
Write-Host "Source: $source"
Write-Host "Destination: $dest"
Write-Host "Fichiers à traiter: $total"
Write-Host ""

foreach ($file in $files) {
    $oldName = $file.Name
    
    # Convertir (cover) → -cover, (logo) → -logo, etc.
    $newName = $oldName -replace ' \(cover\)', '-cover'
    $newName = $newName -replace ' \(logo\)', '-logo'
    $newName = $newName -replace ' \(artwork\)', '-artwork'
    $newName = $newName -replace ' \(gameplay\)', '-gameplay'
    
    $sourcePath = $file.FullName
    $destPath = Join-Path $dest $newName
    
    # Copier (pas déplacer pour garder l'original)
    Copy-Item $sourcePath $destPath -Force
    
    $processed++
    
    if ($processed % 50 -eq 0) {
        Write-Host "Traité: $processed / $total" -ForegroundColor Yellow
    }
}

Write-Host ""
Write-Host "✅ Migration terminée!" -ForegroundColor Green
Write-Host "   Fichiers copiés: $processed"
Write-Host ""
Write-Host "Vérification..."
$destCount = (Get-ChildItem $dest -File).Count
Write-Host "   Images dans '$dest': $destCount" -ForegroundColor Gray
