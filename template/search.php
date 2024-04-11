<?php

namespace App\Boutique\Controllers;
use App\Boutique\Components\SearchForm;
$serverName = $_SERVER['HTTP_HOST'];

$searchForm = new SearchForm();
echo $searchForm->View();
?>
<h1>Barre de recherche</h1>