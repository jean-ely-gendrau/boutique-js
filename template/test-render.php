<h1>Test classe render</h1>
<?php foreach ($product->produitLeak() as $productItem): ?>
    <div>

        <!-- <img src="http://<//?= $serverName ?>/assets/images/<//?= $productItem[
    'images'
] ?>" alt="<?= $productItem['name'] ?>"> -->
        <img src="http://<?= $serverName ?>/assets/images/<?= $productItem[
    'images'
]['main'] ?>" alt="<?= $productItem[
    'name'
] ?>" class="w-32 h-28 mx-auto mt-12" />
        <?= $productItem['name'] ?><br>
        <?= $productItem['price'] ?> €<br>
        <?= $productItem['description'] ?><br>
        - Quantité: <?= $productItem['quantity'] ?><br>
        Créé le <?= $productItem['created_at'] ?><br>
        Modifié le <?= $productItem['updated_at'] ?><br>
    </div>
    <br>
<?php endforeach; ?>
