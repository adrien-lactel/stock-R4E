# Vue "Prix Console" désactivée

## Date
24 janvier 2026

## Raison
Retrait de la vue "Prix consoles" qui permettait de gérer les prix par magasin de façon centralisée.

## Fichiers modifiés (code commenté, non supprimé)

### 1. Routes - `routes/web.php`
- ❌ Commenté l'import : `use App\Http\Controllers\Admin\ConsolePriceController;`
- ❌ Commenté les routes :
  - `Route::get('/prices', [ConsolePriceController::class, 'index'])->name('prices.index');`
  - `Route::post('/prices/{console}', [ConsolePriceController::class, 'store'])->name('prices.store');`

### 2. Navigation - `resources/views/layouts/navigation.blade.php`
- ❌ Commenté le lien menu desktop : "💰 Prix consoles"
- ❌ Commenté le lien menu mobile : "💰 Prix consoles"

### 3. Dashboard - `resources/views/dashboard.blade.php`
- ❌ Commenté la carte "Prix des consoles"

### 4. Dashboard Admin Controller - `app/Http/Controllers/Admin/DashboardController.php`
- ❌ Commenté la carte dashboard "Prix consoles"

## Fichiers NON modifiés (conservés pour référence future)

### Contrôleur
- ✅ `app/Http/Controllers/Admin/ConsolePriceController.php` - CONSERVÉ (peut être réutilisé)

### Modèle
- ✅ `app/Models/ConsoleStorePrice.php` - CONSERVÉ (utilisé par d'autres fonctionnalités)

### Vue
- ✅ `resources/views/admin/prices/index.blade.php` - CONSERVÉE (peut être réutilisée)

### Migrations
- ✅ Table `console_store_prices` - CONSERVÉE (données existantes préservées)

## Fonctionnalités conservées

### ✅ Prix par magasin dans l'édition console
La route `admin.consoles.prices.store` reste ACTIVE dans `ConsoleAdminController`.
Elle permet de définir les prix depuis la page d'édition de chaque console.

Fichier concerné : `resources/views/admin/consoles/edit.blade.php` (ligne 265)

## Pour réactiver la vue "Prix Console"

1. Décommenter l'import dans `routes/web.php` (ligne 13)
2. Décommenter les routes dans `routes/web.php` (lignes 297-304)
3. Décommenter les liens dans `layouts/navigation.blade.php` (lignes 51-54 et 205-207)
4. Décommenter la carte dans `dashboard.blade.php` (lignes 31-39)
5. Décommenter la carte dans `DashboardController.php` (lignes 122-127)
6. Exécuter : `php artisan route:clear && php artisan view:clear`

## Test de validation

```bash
# Vérifier que les routes sont bien retirées
php artisan route:list --name=prices

# Ne devrait afficher que : admin.consoles.prices.store
# Les routes admin.prices.index et admin.prices.store ne doivent PAS apparaître
```

## Impact
- ✅ Aucune erreur 404 : tous les liens sont commentés
- ✅ Données préservées : la table `console_store_prices` reste intacte
- ✅ Fonctionnalité alternative : les prix peuvent toujours être définis via l'édition de console
- ✅ Code récupérable : tout le code est commenté, pas supprimé
