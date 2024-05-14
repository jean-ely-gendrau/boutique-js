<?php

namespace App\Boutique\EntityManager;

use Motor\Mvc\Manager\CrudApi;
use App\Boutique\Models\ProductsModels;

class ProductsEntity extends CrudApi
{
    private int $numberOfOrder;
    private int $revenue;

    public function __construct()
    {
        parent::__construct('products', ProductsModels::class);
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */
    /* __get magic
     * https://www.php.net/manual/en/language.oop5.magic.php
     */
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    /*
     * Depuis Php 8.2 il est recommandé de ne pas implémenter cette méthode
     * sinon on obtiendrait une erreur de ce type
     * Using Dynamic Properties on Classes running PHP 8.2 will lead to PHP Deprecated
     */
    public function __set(string $property, mixed $value)
    {
    }

    /********************************************** Méthode de L'API */

    /**
     * Method getAll Products NATURAL JOIN CATEGORY SUB CAT
     *
     * @params array $select [les collones à séléctionner | si null toutes les collones seront extraite]
     * @return string|array
     */
    public function getAllPaginate(?array $select = null, bool $returnJson = false): string|array
    {
        //     GROUP BY ord.id_product
        $selectItem = is_null($select) ? '*' : join(', ', $select);

        $sql = "SELECT prod.* , i.url_image, i.image_main, c.name as catName, sub.name as subCatName, ord.id 
            FROM {$this->getTableName()} as prod 
            LEFT JOIN category as c ON prod.category_id = c.id 
            LEFT JOIN sub_category as sub ON prod.sub_category_id = sub.id  
            LEFT JOIN productsimages pi ON prod.id = pi.products_id 
            LEFT JOIN images i ON pi.images_id = i.id 
            LEFT JOIN productsorders as prod_order ON prod.id = prod_order.products_id 
            LEFT JOIN orders as ord ON prod_order.orders_id = ord.id 
            LIMIT :limit OFFSET :offset";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute([':limit' => $this->limit, ':offset' => $this->offset]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());

        //var_dump($req->fetchAll());
        // self::paginatePerItem();
        //var_dump($this->limit, $this->offset);

        return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
    }

    /**
     * Method getAllProductPaginate Products
     *
     * @params array $select [les collones à séléctionner | si null toutes les collones seront extraite]
     * @return string|array
     */
    public function getAllProductPaginate(int $categoryID, ?array $select = null, bool $returnJson = false): string|array
    {
        //     GROUP BY ord.id_product
        $selectItem = is_null($select) ? '*' : join(', ', $select);

        $sql = "SELECT prod.* , i.url_image, i.image_main, c.name as catName, sub.name as subCatName
            FROM {$this->getTableName()} as prod 
            LEFT JOIN category as c ON prod.category_id = c.id 
            LEFT JOIN sub_category as sub ON prod.sub_category_id = sub.id  
            LEFT JOIN productsimages pi ON prod.id = pi.products_id 
            LEFT JOIN images i ON pi.images_id = i.id 
            WHERE prod.category_id = :category_id
            LIMIT :limit OFFSET :offset";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute([':limit' => $this->limit, ':offset' => $this->offset, 'category_id' => $categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());

        //var_dump($req->fetchAll());
        // self::paginatePerItem();
        //var_dump($this->limit, $this->offset);

        return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
    }


    /**
     * Method getSubCategoryById 
     *
     * @param int $categoryID [int de la sous catégorie produit]
     * @return array
     */
    public function getSubCategoryById(int $categoryID): array
    {

        $sql = "SELECT c.id, c.name as catName, sub.name as subCatName 
            FROM {$this->getTableName()} as c 
            LEFT JOIN sub_category as sub ON prod.sub_category_id = sub.id  
            WHERE prod.category_id = :category_id";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute(['category_id' => $categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());


        return $req->fetchAll();
    }

    /**
     * Method getCategoryById 
     *
     * @param int $categoryID [int de la catégorie produit]
     * @return array
     */
    public function getCategoryById(int $categoryID): array
    {

        $sql = "SELECT c.id, c.name as catName
            FROM {$this->getTableName()} as c  
            WHERE prod.category_id = :category_id";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute(['category_id' => $categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());


        return $req->fetchAll();
    }
}
