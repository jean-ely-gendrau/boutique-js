<?php


namespace App\Boutique\Controllers;

use App\Boutique\EntityManager\SearchEntity;
use App\Boutique\Models\ProductsModels;
use App\Models\SearchModel;
use App\Utils\Render;
use Motor\Mvc\Manager\CrudManager;

class SearchController extends CrudManager
{
    public function __construct()
    {
        parent::__construct('users', ProductsModels::class);
    }
    
    public function SearchProduct(...$arguments)
    {
         /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];
         try {
            $decodedProductName = urldecode($arguments["name"]); // Décoder la chaîne reçue
            $cleanedProductName = trim($decodedProductName);
            $searchEntity = new SearchEntity();
            $results = $searchEntity->searchProductsLike($cleanedProductName);

            header('Content-Type: application/json');
            echo json_encode($results);
        } catch (\Exception $e) {
            header('Content-Type: application/json', true, 500);
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit;

        // Methode de requête SearchEntity avec passage de name en paramètre
        // $getProduct = new SearchEntity();

        // $nameProduct = $arguments["name"] ?? null;

        // $getTheProduct = $getProduct->searchProductsLike($nameProduct);
        
        // $render->addParams('researchProduct', $getTheProduct);

        // header("Content-type: application/json;charset=utf-8");
        // http_response_code(200);
        // echo json_encode($getTheProduct);
        // exit();
        
    }
}