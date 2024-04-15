<h1>Café</h1>

<?php

use App\Boutique\Models\Products;
use App\Boutique\Manager\BddManager;

$categoryName = "café"; 

$database = new BddManager();
$link = $database->linkConnect();

$rankObject = new Products($dataBase);
$rankObject->produitLeak($categoryName);

?>