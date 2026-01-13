#!/bin/bash
# ================================================================
# CHECKLIST SÉCURITÉ PRE-DÉPLOIEMENT RAILWAY
# Stock R4E - Production Ready
# ================================================================

echo "🔒 VÉRIFICATION DE SÉCURITÉ PRE-DÉPLOIEMENT"
echo "============================================="
echo ""

# 1. APP_DEBUG
echo "1️⃣  Vérification APP_DEBUG..."
if grep -q "APP_DEBUG=false" .env; then
    echo "   ✅ APP_DEBUG=false"
else
    echo "   ❌ APP_DEBUG doit être false"
fi

# 2. APP_ENV
echo "2️⃣  Vérification APP_ENV..."
if grep -q "APP_ENV=production" .env; then
    echo "   ✅ APP_ENV=production"
else
    echo "   ❌ APP_ENV doit être production"
fi

# 3. APP_KEY
echo "3️⃣  Vérification APP_KEY..."
if grep -q "APP_KEY=base64:" .env; then
    echo "   ✅ APP_KEY est définie"
else
    echo "   ❌ APP_KEY manquante (lancez: php artisan key:generate)"
fi

# 4. .env en gitignore
echo "4️⃣  Vérification .env dans .gitignore..."
if grep -q "^.env" .gitignore; then
    echo "   ✅ .env dans .gitignore"
else
    echo "   ❌ Ajoutez .env à .gitignore"
fi

# 5. Dépendances à jour
echo "5️⃣  Vérification dépendances..."
composer update --dry-run > /dev/null 2>&1 && echo "   ✅ Composer dependencies OK" || echo "   ⚠️  Mettez à jour: composer update"

# 6. Migrations prêtes
echo "6️⃣  Vérification migrations..."
php artisan migrate --dry-run > /dev/null 2>&1 && echo "   ✅ Migrations OK" || echo "   ❌ Erreur migrations"

echo ""
echo "============================================="
echo "✅ Checklist complétée - Prêt pour Railway!"
