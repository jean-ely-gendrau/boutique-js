<?php

namespace App\Boutique\Entity;

use App\Boutique\Manager\CrudApi;
use App\Boutique\Models\ProductsModels;

class ProductsEntity extends CrudApi
{

  public function __construct()
  {
    parent::__construct('products', ProductsModels::class);
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
    $selectItem = is_null($select) ? '*' : join(', ', $select);

    $sql = "SELECT p.* , c.name as id_category, sub.name as id_sub_cat 
            FROM {$this->getTableName()} as p 
            LEFT JOIN category as c ON p.id_category = c.id_category 
            LEFT JOIN sub_category as sub ON p.id_sub_cat = sub.id_sub_cat";
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
    $req->execute();
    $req->setFetchMode(
      \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
      $this->getObjectClass(),
    );
    // self::paginatePerItem();
    return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
  }
}
