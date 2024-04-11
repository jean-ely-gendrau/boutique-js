<h1>Test classe render</h1>
<?php foreach ($product->produitLeak() as $productItem): ?>
    <div>
        <?php
        $imageData = json_decode($productItem['images'], true);
        // Vérifier si la clé 'images' existe dans le tableau associatif
        if (isset($imageData[0])) {
            if (isset($imageData[0]['images'])) {
                // Afficher l'image en utilisant le nom du fichier récupéré du tableau associatif
                echo '<img src="http://' .
                    $serverName .
                    '/assets/images/' .
                    $imageData[0]['images'] .
                    '" alt="' .
                    $productItem['name'] .
                    '"/><br>';
            } else {
                // Gérer le cas où la clé 'images' est absente ou vide
                echo 'Image non disponible';
            }
        } else {
            echo 'Image non disponible';
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
