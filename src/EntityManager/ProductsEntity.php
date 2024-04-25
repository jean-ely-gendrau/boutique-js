<?php

namespace App\Boutique\EntityManager;

use App\Boutique\Manager\CrudApi;
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
        //       LEFT JOIN orders as ord ON p.id_order = ord.id_order   COUNT(ord.id_product) as countMaxOrderProduct
        $sql = "SELECT p.* , c.name as nameCat, sub.name as nameSubCat , ord.id_order 
            FROM {$this->getTableName()} as p 
            LEFT JOIN category as c ON p.id_category = c.id_category 
            LEFT JOIN sub_category as sub ON p.id_sub_cat = sub.id_sub_cat
            LEFT JOIN orders as ord ON p.id_product = ord.id_product 
        
            LIMIT :limit OFFSET :offset";
        /*
    $sql = "SELECT p.* , c.name as id_category  
    FROM {$this->getTableName()} as p 
    NATURAL JOIN category as c";
*/
        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute([':limit' => $this->limit, ':offset' => $this->offset]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());
        //var_dump($req->fetchAll());
        // self::paginatePerItem();
        return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
    }
}
