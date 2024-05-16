<?php

namespace App\Boutique\EntityManager;

use Motor\Mvc\Manager\CrudApi;
use App\Boutique\Models\Category;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\SubCategory;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Special\CategorySubCat;

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

        // $sql = "SELECT prod.* , i.url_image, i.image_main, c.name as catName, sub.name as subCatName
        //     FROM {$this->getTableName()} as prod 
        //     LEFT JOIN category as c ON prod.category_id = c.id 
        //     LEFT JOIN sub_category as sub ON prod.sub_category_id = sub.id  
        //     LEFT JOIN productsimages pi ON prod.id = pi.products_id 
        //     LEFT JOIN images i ON pi.images_id = i.id 
        //     WHERE prod.category_id = :category_id
        //     LIMIT :limit OFFSET :offset";

        if (isset($_SESSION['isConnected'])) {
            $crudManagerUser = new CrudManager('users', ProductsModels::class);
            $user = $crudManagerUser->getByEmail($_SESSION['email']);
            $sql = "SELECT prod.*, i.url_image, i.image_main, c.name as catName, sub.name as subCatName, IF(uhp.products_id IS NOT NULL, 1, 0) AS user_has_product
            FROM {$this->getTableName()} as prod 
            LEFT JOIN category as c ON prod.category_id = c.id 
            LEFT JOIN sub_category as sub ON prod.sub_category_id = sub.id 
            LEFT JOIN productsimages pi ON prod.id = pi.products_id 
            LEFT JOIN images i ON pi.images_id = i.id 
            LEFT JOIN users_has_products uhp ON prod.id = uhp.products_id AND uhp.users_id = $user->id
            WHERE prod.category_id = :category_id
            LIMIT :limit OFFSET :offset";
        } else {
            $sql = "SELECT prod.* , i.url_image, i.image_main, c.name as catName, sub.name as subCatName
            FROM {$this->getTableName()} as prod 
            LEFT JOIN category as c ON prod.category_id = c.id 
            LEFT JOIN sub_category as sub ON prod.sub_category_id = sub.id  
            LEFT JOIN productsimages pi ON prod.id = pi.products_id 
            LEFT JOIN images i ON pi.images_id = i.id 
            WHERE prod.category_id = :category_id
            LIMIT :limit OFFSET :offset";
        }


        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        // var_dump($sql);
        $req = $connect->prepare($sql);
        $req->execute([':limit' => $this->limit, ':offset' => $this->offset, 'category_id' => $categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());

        // var_dump($req->fetchAll());
        // self::paginatePerItem();
        //var_dump($this->limit, $this->offset);

        return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
    }


    /**
     * Method getSubCategoryById 
     * 
     *  Retourne un tableau de résultat d'un sous catégorie en fonction de son ID
     *  Retourne false si aucun résultat n'as été trouvé.
     * 
     * @param int $sub_categoryID [int de la sous catégorie de produit]
     * @return array
     */
    public function getSubCategoryById(int $sub_categoryID): array
    {

        $sql = "SELECT sub.*
            FROM sub_category as sub
            WHERE sub.id = :sub_categoryID";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute(['sub_categoryID' => $sub_categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, SubCategory::class);


        return $req->fetchAll();
    }


    /**
     * Method getSubCategoryByCategoryId 
     *
     * Retourn un tebleau de toutes les sous catégories d'une catégories en fonction de son ID
     * 
     * @param int $categoryID [int de la catégorie produit]
     * @return array
     */
    public function getSubCategoryByCategoryId(int $categoryID): array
    {

        $sql = "SELECT c.id as idCat, c.name as nameCat, c.description as descriptionCat ,sub.id as idSubCat, sub.name as nameSubCat, sub.description as descriptionSubCat , sub.category_id
            FROM {$this->getTableName()} as c 
            LEFT JOIN sub_category as sub ON c.id = sub.category_id  
            WHERE c.id = :category_id";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute(['category_id' => $categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, CategorySubCat::class);


        return $req->fetchAll();
    }

    /**
     * Method getCategoryById 
     *
     * Retourn un tableau de résultat de la catégorie en fonction de son ID
     * Retourne false si aucun résultat n'as été trouvé
     * 
     * @param int $categoryID [int de la catégorie produit]
     * @return false|Category
     */
    public function getCategoryById(int $categoryID): false|Category
    {

        $sql = "SELECT c.id, c.name, c.description 
            FROM category as c  
            WHERE c.id = :category_id";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute(['category_id' => $categoryID]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Category::class);


        return $req->fetch();
    }

    /**
     * Method getAllCategory
     *
     * Retourn un tableau de résultat de toutes les catégories 
     * 
     * @return array
     */
    public function getAllCategory(): array
    {

        $sql = "SELECT c.id, c.name, c.description 
            FROM category as c";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, Category::class);


        return $req->fetchAll();
    }
}
