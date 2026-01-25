<!DOCTYPE html>
<html>
<head>
    <title>Test Description Update</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { color: green; font-weight: bold; }
        .info { color: blue; }
        pre { background: #f5f5f5; padding: 15px; border-radius: 5px; }
    </style>
</head>
<body>
    <h1>🧪 Test de mise à jour de description</h1>
    
    <?php
    require 'vendor/autoload.php';
    $app = require_once 'bootstrap/app.php';
    $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    use App\Models\Console;
    use App\Models\ArticleType;
    
    // Récupérer un article Game Boy Color
    $console = Console::whereHas('articleType', function($q) {
        $q->whereHas('subCategory', function($q2) {
            $q2->where('name', 'Game Boy Color');
        });
    })->first();
    
    if ($console) {
        $type = $console->articleType;
        
        echo "<div class='info'>";
        echo "<h2>📦 Article de test</h2>";
        echo "<p><strong>ID:</strong> {$console->id}</p>";
        echo "<p><strong>Type:</strong> {$type->name}</p>";
        echo "<p><strong>Sous-catégorie:</strong> {$type->subCategory->name}</p>";
        echo "</div>";
        
        echo "<h3>Description actuelle:</h3>";
        echo "<pre>" . htmlspecialchars($type->description) . "</pre>";
        
        echo "<h3>✅ Pour tester la mise à jour:</h3>";
        echo "<ol>";
        echo "<li>Allez sur <a href='/admin/articles/{$console->id}/edit' target='_blank'>/admin/articles/{$console->id}/edit</a></li>";
        echo "<li>Vérifiez que le champ 'Description du produit' s'affiche et contient la description ci-dessus</li>";
        echo "<li>Modifiez la description</li>";
        echo "<li>Cliquez sur 'Enregistrer'</li>";
        echo "<li>Rechargez cette page pour vérifier que la modification a bien été enregistrée</li>";
        echo "</ol>";
        
        echo "<h3>🔍 Debug Info:</h3>";
        echo "<pre>";
        echo "article_type_id: {$console->article_type_id}\n";
        echo "Type ID: {$type->id}\n";
        echo "Description length: " . strlen($type->description) . " caractères\n";
        echo "</pre>";
        
    } else {
        echo "<p class='info'>❌ Aucun article Game Boy Color trouvé. Créez-en un d'abord.</p>";
    }
    ?>
    
    <hr>
    <p><small>Généré le <?= date('Y-m-d H:i:s') ?></small></p>
</body>
</html>
