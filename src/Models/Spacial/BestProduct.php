<?php

namespace App\Boutique\Models\Special;

use App\Boutique\Models\Orders;

class BestProduct
{
  protected $productId;

  protected $productName;

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
