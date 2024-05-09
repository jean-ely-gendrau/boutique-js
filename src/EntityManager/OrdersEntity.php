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
}
