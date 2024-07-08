<?php

namespace App\Boutique\EntityManager;

use App\Boutique\Models\Comments;
use App\Boutique\Models\Orders;
use App\Boutique\Models\Ratings;
use App\Boutique\Models\Special\CommentRatings;
use Motor\Mvc\Manager\CrudApi;

class CommentRatingsEntity extends CrudApi
{

  /**
   * crudComments
   *
   * @param CrudApi
   */
  private $crudComments;

  /**
   * crudComments
   *
   * @param CrudApi
   */
  private $crudRatings;

  public function __construct()
  {
    parent::__construct('orders', Orders::class);
    $crudComments = new CrudApi('comments', Comments::class);
    $crudRatings = new CrudApi('ratings', Ratings::class);
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

  public function getByProdId_UserId(array $slqParams)
  {
    $req = $this->_dbConnect->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE users_id = :users_id AND products_id = :products_id');
    $req->execute($slqParams);
    $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

    return $req->fetch();
  }
}
