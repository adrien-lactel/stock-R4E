# TEST SNES SUR PRODUCTION

## URLs à tester:
https://web-production-f3333.up.railway.app/admin/articles/create

## Recherches à effectuer:

### 1. ROM ID simple (SHVC-23):
- Rechercher: `SHVC-23` ou `Super Family Circuit`
- ✅ Devrait afficher: couverture + ROM ID badge

### 2. ROM ID complexe (SHVC-A20J-JPN):
- Rechercher: `SHVC-A20J-JPN` ou `Bakumatsu`
- ✅ Devrait afficher: couverture + ROM ID badge

### 3. ROM ID complexe (SHVC-A27J-JPN):
- Rechercher: `SHVC-A27J-JPN` ou `Super Famista 5`
- ✅ Devrait afficher: couverture + artwork

### 4. ROM ID complexe (SFT-0112-JPN):
- Rechercher: `SFT-0112-JPN` ou `Sailor Moon`
- ✅ Devrait afficher: couverture

## Vérifications:
1. Autocomplete montre les suggestions avec ROM ID badges
2. Images miniatures apparaissent dans le dropdown
3. Cliquer sur un jeu charge les images dans la grid
4. Modal taxonomie s'ouvre avec cover + artwork (si disponible)

## Images R2 disponibles:
- Total: 1959 ROM IDs avec images (1510 covers + 764 artworks)
- Simples: 1185 ROM IDs (SHVC-XX)
- Complexes: 774 ROM IDs (SHVC-XXX-JPN, etc.)

## Note:
Le code cherche déjà correctement:
`https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/{ROM_ID}-cover.png`
