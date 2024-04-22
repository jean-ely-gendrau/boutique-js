<?php

use App\Boutique\Models\ElementProduit;
use App\Boutique\Manager\BddManager;

$id_product = $params["id_product"];

$bddManager = new BddManager();
$link = $bddManager->linkConnect();

$rankObject = new ElementProduit($bddManager);
$rankObject->produitElement($id_product);
?>