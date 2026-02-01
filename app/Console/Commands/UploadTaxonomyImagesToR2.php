<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UploadTaxonomyImagesToR2 extends Command
{
    protected $signature = 'taxonomy:upload-to-r2 
                            {--full : Réuploader tous les fichiers (par défaut: sync seulement les nouveaux)}
                            {--force : Forcer la réupload même si le fichier existe déjà}';
    protected $description = 'Upload taxonomy images to Cloudflare R2 (sync incrémental par défaut)';

    private $mapping = [];
    private $uploadedCount = 0;
    private $skippedCount = 0;
    private $errorCount = 0;

    public function handle()
    {
        $fullSync = $this->option('full');
        $force = $this->option('force');
        
        $mode = $fullSync ? '🔄 FULL SYNC' : '⚡ SYNC INCRÉMENTAL';
        $this->info("📁 {$mode} - Upload vers Cloudflare R2");
        
        if ($force) {
            $this->warn('⚠️  Mode FORCE activé - Tous les fichiers seront réuploadés');
        }
        
        $basePath = public_path('images/taxonomy');
        
        if (!is_dir($basePath)) {
            $this->error("❌ Dossier non trouvé: {$basePath}");
            return 1;
        }

        // Charger le mapping existant
        $this->loadExistingMapping();

        // Récupérer tous les dossiers de taxonomie
        $folders = File::directories($basePath);
        $this->info('📂 Trouvé ' . count($folders) . ' dossiers à uploader');

        foreach ($folders as $folderPath) {
            $folderName = basename($folderPath);
            $this->uploadFolder($folderName, $folderPath);
        }

        // Sauvegarder le mapping
        $this->saveMapping();

        $this->newLine();
        $this->info("✅ Upload terminé !");
        $this->info("📊 Fichiers uploadés: {$this->uploadedCount}");
        
        if ($this->skippedCount > 0) {
            $this->comment("⏭️  Fichiers ignorés (déjà sur R2): {$this->skippedCount}");
        }
        
        if ($this->errorCount > 0) {
            $this->warn("⚠️  Erreurs: {$this->errorCount}");
        }

        return 0;
    }

    private function uploadFolder($folderName, $folderPath)
    {
        $files = File::files($folderPath);
        $totalFiles = count($files);

        if ($totalFiles === 0) {
            $this->warn("⚠️  Dossier vide: {$folderName}");
            return;
        }

        $this->info("\n📂 Traitement : {$folderName}");
        $progressBar = $this->output->createProgressBar($totalFiles);
        $progressBar->start();

        $this->mapping[$folderName] = [];

        foreach ($files as $file) {
            $filename = $file->getFilename();
            $localPath = $file->getPathname();
            
            // Chemin dans R2 : taxonomy/gameboy/DMG-A1J-cover.png
            $r2Path = "taxonomy/{$folderName}/{$filename}";

            // SYNC INTELLIGENT : Skip si déjà uploadé (sauf si --full ou --force)
            if (!$this->option('full') && !$this->option('force')) {
                if (isset($this->mapping[$folderName][$filename])) {
                    $this->skippedCount++;
                    $progressBar->advance();
                    continue;
                }
            }

            try {
                // Upload vers R2
                $fileContent = File::get($localPath);
                $uploaded = Storage::disk('r2')->put($r2Path, $fileContent, 'public');

                if ($uploaded) {
                    // Construire l'URL publique
                    $publicUrl = env('R2_PUBLIC_URL') . '/' . $r2Path;
                    
                    // Sauvegarder dans le mapping
                    $this->mapping[$folderName][$filename] = $publicUrl;
                    
                    $this->uploadedCount++;
                } else {
                    $this->errorCount++;
                    $this->newLine();
                    $this->error("  ❌ Erreur pour {$filename}");
                }
            } catch (\Exception $e) {
                $this->errorCount++;
                $this->newLine();
                $this->error("  ❌ Erreur pour {$filename}: " . $e->getMessage());
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->newLine();
    }

    private function loadExistingMapping()
    {
        $mappingPath = storage_path('app/taxonomy-r2-mapping.json');
        
        if (File::exists($mappingPath)) {
            $this->mapping = json_decode(File::get($mappingPath), true) ?? [];
            $totalFiles = array_sum(array_map('count', $this->mapping));
            $this->comment("📥 Mapping existant chargé: {$totalFiles} fichiers déjà sur R2");
        } else {
            $this->comment("📝 Aucun mapping existant - Premier upload");
        }
    }

    private function saveMapping()
    {
        $mappingPath = storage_path('app/taxonomy-r2-mapping.json');
        
        File::put($mappingPath, json_encode($this->mapping, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        $this->info("💾 Mapping sauvegardé : {$mappingPath}");
        
        // Copier automatiquement dans public/storage/app pour l'accès web
        $publicMappingPath = public_path('storage/app/taxonomy-r2-mapping.json');
        File::ensureDirectoryExists(dirname($publicMappingPath));
        File::copy($mappingPath, $publicMappingPath);
        $this->comment("📋 Mapping copié dans public/storage/app/");
    }
}
