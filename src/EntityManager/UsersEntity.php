<?php

namespace App\Boutique\EntityManager;

use App\Boutique\Models\Users;
use App\Boutique\Manager\CrudApi;

class UsersEntity extends CrudApi
{
    public function __construct()
    {
        parent::__construct('users', Users::class);
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
     * Method getAll Users
     *
     * @params array $select [les collones à séléctionner | si null toutes les collones seront extraite]
     * @return string|array
     */
    public function getAllPaginate(?array $select = null, bool $returnJson = false): string|array
    {
        $selectItem = is_null($select) ? '*' : join(', ', $select);

        $sql = "SELECT {$selectItem} 
            FROM {$this->getTableName()} 
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

        // self::paginatePerItem();
        return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
    }
}
