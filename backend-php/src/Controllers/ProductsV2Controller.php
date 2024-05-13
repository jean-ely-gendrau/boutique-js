<?php

namespace App\Boutique\Controllers;

use App\Boutique\EntityManager\ProductsEntity;

class ProductsV2Controller
{
  public function __construct()
  {
  }

  public function Product(...$arguments): string
  {
    /** @var \Motor\Mvc\Utils\Render $render */
    $render = $arguments['render'];

    // Requête SQL
    $productEntity = new ProductsEntity();
    $productAllSelect = $productEntity->getAllProductPaginate($arguments['categoryName']);

    // Ajout de paramètre au template
    $render->addParams('productAllSelect', $productAllSelect);

    // Affichage
    return $render->render('products', $arguments);
  }
}
