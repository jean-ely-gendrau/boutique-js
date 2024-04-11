<h1>Test classe render</h1>
<?php foreach ($product->produitLeak() as $productItem): ?>
    <div>
        <img src="./image/produit/<?= $productItem[
            'images'
        ] ?>" alt="<?= $productItem['name'] ?>"><br>
        <?= $productItem['name'] ?><br>
        <?= $productItem['price'] ?> €<br>
        <?= $productItem['description'] ?><br>
        - Quantité: <?= $productItem['quantity'] ?><br>
        Créé le <?= $productItem['created_at'] ?><br>
        Modifié le <?= $productItem['updated_at'] ?><br>
    </div>
    <br>
<?php endforeach; ?>

