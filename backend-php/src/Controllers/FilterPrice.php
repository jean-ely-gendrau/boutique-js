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
        // if (!isset($arguments['filter']) && !isset($arguments['idSubCat'])) {
        //     $sql = $this->selectProductQuery($arguments['idCat'], null, null);
        // } else {
        //     $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        // }
        // var_dump($arguments);
        // $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        // echo json_encode($sql);
        if (!isset($arguments['filter']) && !isset($arguments['idSubCat'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], null, null);
        } elseif (!isset($arguments['filter'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], null);
        } elseif (!isset($arguments['idSubCat'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], null, $arguments['filter']);
        } elseif (isset($arguments['idSubCat']) && isset($arguments['idSubCat'])) {
            $sql = $this->selectProductQuery($arguments['idCat'], $arguments['idSubCat'], $arguments['filter']);
        }
        // var_dump($sql);
        if (isset($sql)) {
            $requestSqlSubCat = $this->getConnectBdd()->prepare($sql);
            $requestSqlSubCat->execute();
            $subCat = $requestSqlSubCat->fetchAll(\PDO::FETCH_ASSOC);
            echo json_encode($subCat);
        }
    }
    private function selectProductQuery($id_category, $id_sub_category = null, $filter = null)
    {

        if (isset($_SESSION['isConnected'])) {
            $crudManagerUser = new CrudManager('users', ProductsModels::class);
            $user = $crudManagerUser->getByEmail($_SESSION['email']);
            $sqlRequest = "SELECT p.*, i.url_image, 
               (SELECT 1 
                FROM users_has_products uhp 
                WHERE uhp.products_id = p.id 
                AND uhp.users_id = $user->id
                LIMIT 1) AS user_has_product
               FROM products p
               LEFT JOIN images i ON p.id = i.id
               WHERE p.category_id = $id_category";
        } else {
            $sqlRequest = "SELECT p.*, i.url_image
               FROM products p
               LEFT JOIN images i ON p.id = i.id
               WHERE p.category_id = $id_category";
        }


        if ($id_sub_category !== null) {
            $sqlRequest .= " AND p.sub_category_id = $id_sub_category";
        }

        if ($filter === 'bestSeller') {
            $sqlRequest .= " ORDER BY (SELECT COUNT(*) FROM productsorders po WHERE po.products_id = p.id) DESC";
        } elseif ($filter === 'bestRated') {
            $sqlRequest .= " ORDER BY (SELECT AVG(rating) FROM ratings r WHERE r.products_id = p.id) DESC";
        } elseif ($filter === 'asc') {
            $sqlRequest .= " ORDER BY p.price ASC";
        } elseif ($filter === 'desc') {
            $sqlRequest .= " ORDER BY p.price DESC";
        }

        $sqlRequest .= " LIMIT 10";

        return $sqlRequest;
    }
}
