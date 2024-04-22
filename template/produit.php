<?php

use App\Boutique\Models\Products;
use App\Boutique\Manager\BddManager;

$categoryName = $params["categoryName"];
$pageURL = "999";

if ($categoryName === "cafe") {
    $categoryName = '0';
    $pageURL = 'café';
    
} elseif ($categoryName === "the") {
    $categoryName = '1';
    $pageURL = 'thé';
}

$bddManager = new BddManager();
$link = $bddManager->linkConnect();

$rankObject = new Products($bddManager);
$rankObject->produitLeak($categoryName, $pageURL);
?>