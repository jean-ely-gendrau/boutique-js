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
        if ($id_sub_category === null && $filter === null) {
            $sqlRequest = "SELECT p.*, i.url_image FROM products p JOIN  images i ON p.id = i.id WHERE p.category_id = $id_category LIMIT 10";
            return $sqlRequest;
        }
        if ($id_sub_category === null) {
            if ($filter === 'bestSeller') {
                $sqlRequest = "SELECT p.id, p.name, p.description, p.price, COUNT(po.products_id) AS total_sold, i.url_image
                FROM products p
                JOIN productsorders po ON p.id = po.products_id
                JOIN sub_category sc ON p.sub_category_id = sc.id
                JOIN images i ON p.id = i.id
                WHERE sc.category_id = $id_category
                GROUP BY p.id, p.name, p.description, p.price, i.url_image
                ORDER BY total_sold DESC
                LIMIT 10;";
                return $sqlRequest;
            } elseif ($filter === 'BestRating') {
                $sqlRequest = "SELECT p.id, p.name, p.description, p.price, AVG(r.rating) AS average_rating, i.url_image
                FROM products p
                JOIN ratings r ON p.id = r.products_id
                JOIN sub_category sc ON p.sub_category_id = sc.id
                JOIN images i ON p.id = i.id
                WHERE sc.category_id = $id_category
                GROUP BY p.id, p.name, p.description, p.price, i.url_image
                ORDER BY average_rating DESC
                LIMIT 10;";
                return $sqlRequest;
            } elseif ($filter === 'asc') {
                $sqlRequest = "SELECT p.*, i.url_image
                FROM products p
                JOIN images i ON p.id = i.id
                WHERE p.category_id = $id_category
                ORDER BY p.price ASC
                LIMIT 10;";
                return $sqlRequest;
            } elseif ($filter === 'desc') {
                $sqlRequest = "SELECT p.*, i.url_image
                FROM products p
                JOIN images i ON p.id = i.id
                WHERE p.category_id = $id_category
                ORDER BY p.price DESC
                LIMIT 10;";
                return $sqlRequest;
            } else {
                $sqlRequest = "SELECT p.*, i.url_image FROM products p JOIN  images i ON p.id = i.id WHERE p.category_id = $id_category LIMIT 10";
                return $sqlRequest;
            }
        } else {
            if ($filter === 'asc') {
                $sqlRequest = "SELECT p.*, i.url_image
                FROM products p
                JOIN images i ON p.id = i.id
                WHERE p.category_id = $id_category
                AND p.sub_category_id = $id_sub_category
                ORDER BY p.price ASC
                LIMIT 10;";
                return $sqlRequest;
            } elseif ($filter === 'desc') {
                $sqlRequest = "SELECT p.*, i.url_image
                FROM products p
                JOIN images i ON p.id = i.id
                WHERE p.category_id = $id_category
                AND p.sub_category_id = $id_sub_category
                ORDER BY p.price DESC
                LIMIT 10;";
                return $sqlRequest;
            } elseif ($filter === null) {
                $sqlRequest = "SELECT * FROM products WHERE category_id = $id_category AND sub_category_id = $id_sub_category LIMIT 10";
                return $sqlRequest;
            } elseif ($filter === 'bestSeller') {
                $sqlRequest = "SELECT p.id, p.name, p.description, p.price, COUNT(po.products_id) AS total_sold, i.url_image
                FROM products p
                JOIN productsorders po ON p.id = po.products_id
                JOIN sub_category sc ON p.sub_category_id = sc.id
                JOIN images i ON p.id = i.id
                WHERE sc.category_id = $id_category AND p.sub_category_id = $id_sub_category
                GROUP BY p.id, p.name, p.description, p.price, i.url_image
                ORDER BY total_sold DESC
                LIMIT 10;";
                return $sqlRequest;
            } elseif ($filter === 'bestRated') {
                $sqlRequest = "SELECT p.id, p.name, p.description, p.price, AVG(r.rating) AS average_rating, i.url_image
                FROM products p
                JOIN ratings r ON p.id = r.products_id
                JOIN sub_category sc ON p.sub_category_id = sc.id
                JOIN images i ON p.id = i.id
                WHERE sc.category_id = $id_category AND p.sub_category_id = $id_sub_category
                GROUP BY p.id, p.name, p.description, p.price, i.url_image
                ORDER BY average_rating DESC
                LIMIT 10;";
                return $sqlRequest;
            } else {
                // Unknown filter
                return "Error: Unknown filter.";
            }
        }
    }
}
