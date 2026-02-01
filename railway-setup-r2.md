# Configuration Railway pour Cloudflare R2

## 1️⃣ Ajouter les variables d'environnement dans Railway

Dashboard Railway → Votre projet → Variables :

```env
R2_ACCESS_KEY_ID=f125602086c04d1d6a889d772df5b06c
R2_SECRET_ACCESS_KEY=900052fc214a3cb3233b6fcbe9171692eca0734b8c45153addd751e5f18e123a
R2_BUCKET=stock-r4e-taxonomy
R2_ENDPOINT=https://cd7a88507187155b85572a413ce5d288.r2.cloudflarestorage.com
R2_PUBLIC_URL=https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev
R2_REGION=auto
```

## 2️⃣ Copier le mapping JSON dans le dépôt

```bash
# Le fichier public/storage/app/taxonomy-r2-mapping.json sera déployé automatiquement
git add -f public/storage/app/taxonomy-r2-mapping.json
git commit -m "Add R2 taxonomy mapping"
git push
```

## 3️⃣ Railway détectera automatiquement

- ✅ Les images seront chargées depuis R2 (URLs publiques)
- ✅ Pas besoin de fichiers locaux en production
- ✅ Bande passante gratuite illimitée

## 🔄 Workflow de mise à jour

Quand vous ajoutez de nouvelles images :

1. **Local** : Ajouter images dans `public/images/taxonomy/`
2. **Sync R2** : `php artisan taxonomy:upload-to-r2`
3. **Deploy** : `git add public/storage/app/taxonomy-r2-mapping.json && git push`

Railway utilisera automatiquement les nouvelles URLs R2 !
