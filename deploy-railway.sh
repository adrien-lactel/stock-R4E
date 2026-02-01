#!/bin/bash
# =====================================================
# Script de déploiement Railway pour Stock R4E avec R2
# =====================================================

echo "🚀 Préparation du déploiement Railway avec Cloudflare R2"

# 1. Vérifier que le mapping R2 existe
if [ ! -f "storage/app/taxonomy-r2-mapping.json" ]; then
    echo "❌ ERREUR: Le fichier taxonomy-r2-mapping.json est manquant !"
    echo "Exécutez d'abord: php artisan taxonomy:upload-to-r2"
    exit 1
fi

# 2. Vérifier le nombre d'images dans le mapping
IMAGE_COUNT=$(jq '[.[] | length] | add' storage/app/taxonomy-r2-mapping.json)
echo "✅ Mapping R2 trouvé: $IMAGE_COUNT images"

# 3. Copier le mapping dans public/storage/app
mkdir -p public/storage/app
cp storage/app/taxonomy-r2-mapping.json public/storage/app/taxonomy-r2-mapping.json
echo "✅ Mapping copié dans public/storage/app/"

# 4. Vérifier les variables d'environnement R2
if [ -z "$R2_ACCESS_KEY_ID" ] || [ -z "$R2_SECRET_ACCESS_KEY" ]; then
    echo "⚠️  ATTENTION: Les variables R2_ACCESS_KEY_ID et R2_SECRET_ACCESS_KEY doivent être configurées dans Railway Dashboard"
fi

# 5. Ajouter le mapping au Git
git add storage/app/taxonomy-r2-mapping.json
git add public/storage/app/taxonomy-r2-mapping.json
git add .gitignore
git add railway.json
git add .env.railway.example

echo ""
echo "✅ Prêt pour le déploiement Railway !"
echo ""
echo "📋 Prochaines étapes :"
echo "1. Commit les changements: git commit -m 'Add R2 configuration for Railway'"
echo "2. Push vers GitHub: git push origin main"
echo "3. Railway déploiera automatiquement"
echo "4. Configurer les variables R2 dans Railway Dashboard (voir .env.railway.example)"
echo ""
echo "🌐 Les images seront chargées depuis: https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev"
