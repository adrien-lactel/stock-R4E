# Configuration CORS sur Cloudflare R2

## Étapes rapides (2 minutes)

1. **Allez sur Cloudflare Dashboard** : https://dash.cloudflare.com
2. **R2** → Sélectionnez le bucket **stock-r4e-taxonomy**
3. **Settings** → **CORS Policy**
4. **Add CORS Policy** et collez :

```json
[
  {
    "AllowedOrigins": ["*"],
    "AllowedMethods": ["GET", "HEAD"],
    "AllowedHeaders": ["*"],
    "ExposeHeaders": [],
    "MaxAgeSeconds": 3600
  }
]
```

5. **Save**

## Test

Après 1 minute, les images chargeront instantanément depuis R2 sans erreur CORS.

## Alternative (si pas d'accès R2)

Utilisez le proxy optimisé avec cache (voir ci-dessous).
