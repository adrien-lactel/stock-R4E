# Upload d'images pour les fiches produits

## Système d'upload intégré

Le système utilise un upload d'images local, sans dépendance à des API externes.

## Configuration

Aucune configuration n'est nécessaire ! Le système fonctionne directement.

### Vérification du lien symbolique

Assurez-vous que le lien symbolique vers le dossier storage est créé :

```bash
php artisan storage:link
```

Cette commande crée un lien entre `storage/app/public` et `public/storage`.

## Utilisation

1. **Créer une fiche produit** :
   - Allez dans "🖼️ Créer une fiche produit"
   - Remplissez les informations du produit
   
2. **Ajouter des images** :
   - Cliquez sur "📤 Choisir des images"
   - Sélectionnez une ou plusieurs images depuis votre ordinateur
   - Les images seront automatiquement uploadées
   
3. **Gérer les images** :
   - La première image ajoutée devient automatiquement l'image principale
   - Survolez une image pour voir les options :
     - ❌ Supprimer l'image
     - ⭐ Définir comme image principale
   
4. **Formats supportés** :
   - JPG, PNG, GIF, WEBP
   - Taille maximale : 5 MB par image
   - Nombre illimité d'images par fiche

## Stockage

Les images sont stockées dans :
- **Serveur** : `storage/app/public/product-sheets/`
- **URL publique** : `public/storage/product-sheets/`

## Avantages

✅ **Pas de dépendance externe** - Fonctionne hors ligne
✅ **Contrôle total** - Vous choisissez exactement vos images
✅ **Rapide** - Upload instantané
✅ **Fiable** - Pas de limite d'API
✅ **Images de qualité** - Utilisez vos propres photos produits
