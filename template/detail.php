<?php

// use App\Boutique\Models\ElementProduit;
// use App\Boutique\Manager\BddManager;

// $id_product = $params["id_product"];

// $bddManager = new BddManager();
// $link = $bddManager->linkConnect();

// $rankObject = new ElementProduit($bddManager);
// $rankObject->produitElement($id_product);


foreach ($detail as $details) :
    $imageData = json_decode($details['images'], true);
    $details['images'] = $imageData;

    ?>

    <img id="<?=$details['id_product']?>" class="article-image" src="http://<?=$serverName?>/assets/images/<?=$details['images']['main']?>"alt="<?=$details["name"]?>">
    <img id="<?=$details['id_product']?>" class="article-image" src="http://<?=$serverPath?>/assets/images/additional<?=$details['images']['additional'][0]?>"alt="<?=$details["name"]?>">
    <img id="<?=$details['id_product']?>" class="article-image" src="http://<?=$serverPath?>/assets/images/<?=$details['images']['additional']['1']?>"alt="<?=$details["name"]?>">
    <!-- les autres images -->
    <?=$details["name"]?>
    <?=$details["price"]?>
    <?=$details["price"]?>
    <!-- etoile classement -->
    <!-- "A propos du café" -->
    
    <?=$details["description"]?>
    <!-- Commentaires -->
    <!-- commentaires barres -->
    <!-- des commentaires -->
    <!-- buttton Read all reviews -->

<?php endforeach; ?>

