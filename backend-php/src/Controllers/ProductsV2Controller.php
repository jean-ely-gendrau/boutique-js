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

    $productEntity = new ProductsEntity();
    $productEntity->getAllProductPaginate();
    var_dump($productEntity);
  }
}
