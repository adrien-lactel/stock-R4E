# CONFIGURATION R2 MANQUANTE SUR RAILWAY

## Problème identifié
Les images de taxonomie SNES ne sont pas trouvées en production car **les credentials R2 ne sont pas configurées** dans Railway.

## Variables d'environnement manquantes sur Railway

Ajoutez ces variables dans Railway → Variables :

```
R2_ACCESS_KEY_ID=f125602086c04d1d6a889d772df5b06c
R2_SECRET_ACCESS_KEY=900052fc214a3cb3233b6fcbe9171692eca0734b8c45153addd751e5f18e123a
R2_BUCKET=stock-r4e-taxonomy
R2_ENDPOINT=https://cd7a88507187155b85572a413ce5d288.r2.cloudflarestorage.com
R2_PUBLIC_URL=https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev
R2_REGION=auto
```

## Fichiers de configuration Laravel à vérifier

### config/filesystems.php
Vérifier que le disque R2 est bien configuré :
```php
'r2' => [
    'driver' => 's3',
    'key' => env('R2_ACCESS_KEY_ID'),
    'secret' => env('R2_SECRET_ACCESS_KEY'),
    'region' => env('R2_REGION', 'auto'),
    'bucket' => env('R2_BUCKET'),
    'endpoint' => env('R2_ENDPOINT'),
    'url' => env('R2_PUBLIC_URL'),
    'use_path_style_endpoint' => false,
],
```

## Test après configuration

1. Dans Railway → Déployez après avoir ajouté les variables
2. Testez cette URL directement :
   ```
   https://web-production-f3333.up.railway.app/admin/taxonomy/get-images?identifier=SHVC-ADFJ-JPN&folder=snes
   ```
3. Devrait retourner un JSON avec les 3 images

## Images disponibles pour SHVC-ADFJ-JPN
- ✅ Cover : https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/SHVC-ADFJ-JPN-cover.png
- ✅ Cover 2 : https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/SHVC-ADFJ-JPN-cover-2.png
- ✅ Artwork : https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/SHVC-ADFJ-JPN-artwork.png
