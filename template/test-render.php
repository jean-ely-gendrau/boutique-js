<h1>Test classe render</h1>
<?php foreach ($product->produitLeak() as $productItem): ?>
    <div>
        <?php
        $imageData = json_decode($productItem['images'], true);
        var_dump(
            '   http://' . $serverName . '/assets/images/' . $imageData['main'],
        );
        // Vérifier si la clé 'images' existe dans le tableau associatif
        if (isset($imageData['main']) && !empty($imageData['main'])) {
            // Construire le chemin du fichier image
            $imagePath = __DIR__ . '/../../assets/images/' . $imageData['main'];

            // Vérifier si le fichier image existe
            if (!file_exists($imagePath)) {
                // L'image existe, affichez-la
                echo '<img src="http://' .
                    $serverName .
                    '/assets/images/' .
                    $imageData['main'] .
                    '" alt="' .
                    $productItem['name'] .
                    '" class="w-32 h-28 mx-auto mt-12"/>';
            } else {
                // L'image n'existe pas, affichez l'image par défaut
                echo '<img src="http://' .
                    $serverName .
                    '/assets/images/coffee1.webp" alt="image de café par défaut" class="w-32 h-28 mx-auto mt-12"/>';
            }
        } else {
            // La clé 'images' est absente ou vide, affichez l'image par défaut
            echo '<img src="http://' .
                $serverName .
                '/assets/images/coffee1.webp" alt="image de café par défaut" class="w-32 h-28 mx-auto mt-12"/>';
        }
        ?>
        <!-- <img src="http://<//?= $serverName ?>/assets/images/<//?= $productItem[
    'images'
] ?>" alt="<?= $productItem['name'] ?>"> -->
        
        <?= $productItem['name'] ?><br>
        <?= $productItem['price'] ?> €<br>
        <?= $productItem['description'] ?><br>
        - Quantité: <?= $productItem['quantity'] ?><br>
        Créé le <?= $productItem['created_at'] ?><br>
        Modifié le <?= $productItem['updated_at'] ?><br>
    </div>
    <br>
<?php endforeach; ?>
