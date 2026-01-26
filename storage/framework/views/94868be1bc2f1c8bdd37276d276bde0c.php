

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">⚠️ Google Cloud Vision Non Configuré</h1>
        
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        L'analyse IA ne fonctionne pas car <strong>Google Cloud Vision n'est pas encore configuré</strong>.
                    </p>
                </div>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">🔧 Solution en 5 étapes</h2>

        <!-- Étape 1 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">1. Créer un compte Google Cloud Platform</h3>
            <p class="text-gray-700 mb-2">Allez sur <a href="https://console.cloud.google.com" target="_blank" class="text-indigo-600 hover:underline">console.cloud.google.com</a></p>
        </div>

        <!-- Étape 2 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">2. Créer un projet</h3>
            <ol class="list-decimal list-inside text-gray-700 space-y-1 ml-4">
                <li>Cliquez sur "Sélectionner un projet" → "Nouveau projet"</li>
                <li>Nom: "Stock-R4E" (ou autre)</li>
                <li>Cliquez "Créer"</li>
            </ol>
        </div>

        <!-- Étape 3 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">3. Activer l'API Cloud Vision</h3>
            <ol class="list-decimal list-inside text-gray-700 space-y-1 ml-4">
                <li>Menu ☰ → "API et services" → "Bibliothèque"</li>
                <li>Cherchez "Cloud Vision API"</li>
                <li>Cliquez "ACTIVER"</li>
            </ol>
        </div>

        <!-- Étape 4 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">4. Créer un compte de service</h3>
            <ol class="list-decimal list-inside text-gray-700 space-y-1 ml-4">
                <li>Menu ☰ → "API et services" → "Identifiants"</li>
                <li>"+ CRÉER DES IDENTIFIANTS" → "Compte de service"</li>
                <li>Nom: "stock-r4e-vision"</li>
                <li>Rôle: "Cloud Vision API User"</li>
                <li>Cliquez "Terminé"</li>
            </ol>
        </div>

        <!-- Étape 5 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">5. Télécharger la clé JSON</h3>
            <ol class="list-decimal list-inside text-gray-700 space-y-1 ml-4">
                <li>Cliquez sur le compte de service créé</li>
                <li>Onglet "CLÉS" → "AJOUTER UNE CLÉ" → "Créer une clé"</li>
                <li>Type: JSON</li>
                <li>Télécharger le fichier (ex: stock-r4e-vision-xxxxx.json)</li>
            </ol>
        </div>

        <!-- Étape 6 -->
        <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
            <h3 class="text-lg font-semibold text-blue-900 mb-2">6. Configurer dans Laravel</h3>
            
            <p class="text-sm font-semibold text-blue-900 mb-2">Ouvrez le fichier .env et ajoutez :</p>
            
            <div class="bg-gray-900 text-gray-100 p-4 rounded font-mono text-sm overflow-x-auto mb-3">
<pre>GOOGLE_VISION_CREDENTIALS='{"type":"service_account","project_id":"xxxxx",...}'
GOOGLE_VISION_PROJECT_ID=xxxxx</pre>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded p-3 mb-3">
                <p class="text-sm font-semibold text-yellow-800 mb-1">⚠️ Important :</p>
                <ul class="list-disc list-inside text-xs text-yellow-700 space-y-1">
                    <li>Utilisez des apostrophes simples <code class="bg-yellow-100 px-1">'...'</code> autour du JSON</li>
                    <li>Copiez TOUT le JSON sur UNE SEULE ligne</li>
                    <li>N'ajoutez PAS de retours à la ligne dans le JSON</li>
                </ul>
            </div>
        </div>

        <!-- Étape 7 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">7. Nettoyer les caches</h3>
            <div class="bg-gray-900 text-gray-100 p-4 rounded font-mono text-sm overflow-x-auto">
<pre>php artisan config:clear
php artisan cache:clear</pre>
            </div>
        </div>

        <!-- Étape 8 -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">8. Tester !</h3>
            <ol class="list-decimal list-inside text-gray-700 space-y-1 ml-4">
                <li>Retournez sur <a href="<?php echo e(route('admin.articles.create')); ?>" class="text-indigo-600 hover:underline">Créer un article</a></li>
                <li>Uploadez une image</li>
                <li>Cliquez "🤖 Analyser avec l'IA"</li>
                <li>Les résultats s'affichent en cartes colorées ! 🎉</li>
            </ol>
        </div>

        <!-- Coût -->
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <h3 class="text-lg font-semibold text-green-900 mb-2">💰 Coût</h3>
            <ul class="list-disc list-inside text-sm text-green-700 space-y-1">
                <li><strong>1000 analyses/mois</strong> : GRATUIT</li>
                <li><strong>Au-delà</strong> : $0.0015 par image (1,5€ pour 1000 images)</li>
            </ul>
        </div>

        <!-- Aide -->
        <div class="bg-gray-50 rounded p-4">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">🆘 Besoin d'aide ?</h3>
            <p class="text-sm text-gray-700 mb-2">Si vous rencontrez des problèmes :</p>
            <ul class="list-disc list-inside text-sm text-gray-700 space-y-1 ml-4">
                <li>Vérifiez les logs Laravel : <code class="bg-gray-200 px-1">storage/logs/laravel.log</code></li>
                <li>Consultez la <a href="https://cloud.google.com/vision/docs/setup" target="_blank" class="text-indigo-600 hover:underline">documentation officielle Google</a></li>
            </ul>
        </div>

        <div class="mt-8 flex gap-4">
            <a href="<?php echo e(route('admin.articles.create')); ?>" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold">
                ← Retour au formulaire
            </a>
            <a href="https://console.cloud.google.com" target="_blank" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                Ouvrir Google Cloud Console →
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/google-vision-setup.blade.php ENDPATH**/ ?>