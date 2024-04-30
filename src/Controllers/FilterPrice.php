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
        if (!isset($arguments['filter']) && !isset($arguments['idSubCat'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], null, null);
        } else {
            $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        }
        // var_dump($arguments);
        // $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        // echo json_encode($sql);
        // if (!isset($arguments['idSubCat'])) {
        //     $sql = $this->selectProductQuery($arguments['idCat'], null, $arguments['orderBy']);
        // } elseif (!isset($arguments['orderBy'])) {
        //     $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        // } elseif (isset($arguments['orderBy']) && isset($arguments['idSubCat']) && isset($arguments['ratings'])) {
        //     $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], $arguments['orderBy']);
        // } elseif (!isset($arguments['ratings'])) {
        //     $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], $arguments['orderBy']);
        // }
        if (isset($sql)) {
            $requestSqlSubCat = $this->getConnectBdd()->prepare($sql);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
            echo json_encode($subCat);
        }
    }
    private function selectProductQuery($id_category, $id_sub_category = null, $filter = null, /* $rating = null, $limit = null*/)
    {
        if ($id_sub_category === null && $filter === null) {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category";
            return $sqlRequest;
        } elseif (isset($id_sub_category) && $filter === 'bestSeller') {
            $sqlRequest = "SELECT * FROM products";
            return $sqlRequest;
        } elseif (isset($id_sub_category) && $filter === 'BestRating') {
            $sqlRequest = "SELECT * FROM products";
            return $sqlRequest;
        } elseif (isset($id_sub_category) && $filter === 'asc') {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND sub_category_id = $id_sub_category ORDER BY price ASC";
            return $sqlRequest;
        } elseif (isset($id_sub_category) && $filter === 'desc') {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND sub_category_id = $id_sub_category ORDER BY price DESC";
            return $sqlRequest;
        } elseif (isset($id_sub_category) && $filter === null) {
            $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND sub_category_id = $id_sub_category";
            return $sqlRequest;
        }
        // }
        // if ($orderBy != null && $id_sub_category == null) {
        //     $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category ORDER BY price $orderBy LIMIT 5";
        //     return $sqlRequest;
        // }
        // if ($orderBy == null && $id_sub_category != null) {
        //     $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND id_sub_cat = $id_sub_category LIMIT 5";
        //     return $sqlRequest;
        // }
        // return $sqlRequest = "SELECT p.*, AVG(r.rating) AS average_rating FROM products p LEFT JOIN ratings r ON p.id = r.product_id WHERE p.category_id = $id_category";
    }
}
