<?php

namespace App\Boutique\EntityManager;

use App\Boutique\Models\Orders;
use Motor\Mvc\Manager\CrudApi;

class OrdersEntity extends CrudApi
{

  public function __construct()
  {
    parent::__construct('orders', Orders::class);
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

    $sql = "SELECT ord.*, u.*  
            FROM {$this->getTableName()} as ord 
            LEFT JOIN users as u ON u.id = ord.users_id 
            LIMIT :limit OFFSET :offset";

    // Désectivation ATTR_EMULATE_PREPARES
    $connect = $this->_dbConnect;
    $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

    //Prépare
    $req = $connect->prepare($sql);
    $req->execute([':limit' => $this->limit, ':offset' => $this->offset]);
    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->getObjectClass());

    var_dump($this->getColumnParam());
    // self::paginatePerItem();
    //var_dump($this->limit, $this->offset);

    return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
  }
}
