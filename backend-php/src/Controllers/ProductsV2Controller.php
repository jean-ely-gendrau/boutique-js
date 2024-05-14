<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Builder\FormBuilder;
use App\Boutique\Forms\ButtonControlForms;
use App\Boutique\Forms\ButtonControllForms;
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

    // PRODUCTS ENTITY
    $productEntity = new ProductsEntity();

    $pagination = $productEntity->paginatePerPage(!isset($arguments['page']) ? 1 : $arguments['page'], 9); // START PAGINATION

    $productAllSelect = $productEntity->getAllProductPaginate($arguments['categoryName']); // GET ALL PRODUCT WITH PAGINATION
    $getSubCategory =  $productEntity->getSubCategoryByCategoryId($arguments['categoryName']); // GET SUB CATEGORY

    /***
     * Button Filter
     */
    $buttonFilter = ButtonControlForms::buttonFilterProduct($getSubCategory);

    /***
     * Button Pagination
     */
    $buttonNavigation = ButtonControlForms::buttonPaginationProduct($pagination, $arguments, $render->getParams('serverName'));

    // Ajout des paramètres au template HTML
    $render->addParams([
      'productAllSelect' => $productAllSelect,
      'pagination' => $pagination,
      'buttonNavigation' => $buttonNavigation,
      'buttonFilter' => $buttonFilter
    ]);

    // Affichage
    return $render->render('products', $arguments);
  }
}
