<?php

namespace App\Boutique\Models\Special;

class BestProduct
{
  protected $productId;

  protected $productName;

  public function __construct()
  {
  }

  /* ----------------------------------- METHOD MAGIC ------------------------------ */

  /**
   * Get magic __get
   *
   * @return mixed
   */
  public function __get($name)
  {
    if (property_exists($this, $name)) {
      return $this->$name;
    }
  }

  /**
   * Set magic __set
   *
   * @param string $property La propriétée
   * @param mixed $value La valeur de la propriétée
   * @return self
   */
  public function __set(string $property, mixed $value)
  {
  }

  /**
   * Get the value of productId
   */
  public function getProductId()
  {
    return $this->productId;
  }

  /**
   * Set the value of productId
   *
   * @return  self
   */
  public function setProductId($productId)
  {
    $this->productId = $productId;

    return $this;
  }

  /**
   * Get the value of productName
   */
  public function getProductName()
  {
    return $this->productName;
  }

  /**
   * Set the value of productName
   *
   * @return  self
   */
  public function setProductName($productName)
  {
    $this->productName = $productName;

    return $this;
  }
}
