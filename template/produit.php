<?php

use App\Boutique\Models\Products;
use App\Boutique\Manager\BddManager;

$categoryName = "666";
$pageURL = "999";

if (isset($_GET['cafe'])) {
    $categoryName = '0';
    $pageURL = 'café';
    
} elseif (isset($_GET['the'])) {
    $categoryName = '1';
    $pageURL = 'thé';
}

$bddManager = new BddManager();
$link = $bddManager->linkConnect();

$rankObject = new Products($bddManager);
$rankObject->produitLeak($categoryName, $pageURL);
?>