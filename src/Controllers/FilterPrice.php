<?php
namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;

class FilterPrice extends CrudManager
{
    public function __construct()
    {
        parent::__construct('products', ProductsModels::class);
    }

    public function testJS(...$arguments)
    {
        $data = 'test.js';
        echo json_encode($data);
    }

    public function produitElement(...$arguments)
    {
        // var_dump($arguments);
        if (!isset($arguments['idSubCat'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], null, $arguments['orderBy']);
        } elseif (!isset($arguments['orderBy'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        } elseif (isset($arguments['orderBy']) && isset($arguments['idSubCat']) && isset($arguments['ratings'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], $arguments['orderBy']);
        } elseif (!isset($arguments['ratings'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], $arguments['orderBy']);
        }
        if (isset($sql)) {
            $requestSqlSubCat = $this->getConnectBdd()->prepare($sql);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
            echo json_encode($subCat);
        }
    }
    private function selectProductQuery($id_category, $id_sub_category = null, $orderBy = null, /* $rating = null, $limit = null*/)
    {
        // var_dump($id_category);
        // var_dump($id_sub_category);
        // var_dump($orderBy);
        if (isset($id_sub_category) && isset($orderBy)) {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND id_sub_cat = $id_sub_category ORDER BY price $orderBy LIMIT 5";
            return $sqlRequest;
        }
        if ($orderBy != null && $id_sub_category == null) {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category ORDER BY price $orderBy LIMIT 5";
            return $sqlRequest;
        }
        if ($orderBy == null && $id_sub_category != null) {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND id_sub_cat = $id_sub_category LIMIT 5";
            return $sqlRequest;
        }
        // $sqlRequest = "SELECT p.*, AVG(r.rating) AS average_rating FROM products p LEFT JOIN ratings r ON p.id = r.product_id WHERE p.category_id = $id_category";
    }
}
