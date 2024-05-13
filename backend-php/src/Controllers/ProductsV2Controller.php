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

    $pagination = $productEntity->paginatePerPage(1, 9);

    $productAllSelect = $productEntity->getAllProductPaginate($arguments['categoryName']);

    // Ajout des paramètres au template HTML
    $render->addParams([
      'productAllSelect' => $productAllSelect,
      'pagination' => $pagination
    ]);

    // Affichage
    return $render->render('products', $arguments);
  }
}
