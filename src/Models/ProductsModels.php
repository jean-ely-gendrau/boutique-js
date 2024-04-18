<?php

namespace App\Boutique\Models;

class ProductsModels
{


  /**
   * name
   *
   * @var string
   */
  private $name;

  /**
   * description
   *
   * @var string
   */
  private $description;

  /**
   * price
   *
   * @var float
   */
  private $price;

  /**
   * quantity
   *
   * @var int
   */
  private $quantity;

  /**
   * images
   *
   * @var array
   */
  private $images;

  /**
   * created_at
   *
   * @var string
   */
  private $created_at;

  /**
   * updated_at
   *
   * @var string
   */
  private $updated_at;

  public function __construct()
  {
    //Ajouté les propriétés et méthodes au besoins
  }


  /************************************** Getter/Setter ***********************************/


  /**
   * Get name
   *
   * @return  string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set name
   *
   * @param  string  $name  name
   *
   * @return  self
   */
  public function setName(string $name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get description
   *
   * @return  string
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set description
   *
   * @param  string  $description  description
   *
   * @return  self
   */
  public function setDescription(string $description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get price
   *
   * @return  float
   */
  public function getPrice()
  {
    return $this->price;
  }

  /**
   * Set price
   *
   * @param  float  $price  price
   *
   * @return  self
   */
  public function setPrice(float $price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get quantity
   *
   * @return  int
   */
  public function getQuantity()
  {
    return $this->quantity;
  }

  /**
   * Set quantity
   *
   * @param  int  $quantity  quantity
   *
   * @return  self
   */
  public function setQuantity(int $quantity)
  {
    $this->quantity = $quantity;

    return $this;
  }

  /**
   * Get images
   *
   * @return  array
   */
  public function getImages()
  {
    return $this->images;
  }

  /**
   * Set images
   *
   * @param  array  $images  images
   *
   * @return  self
   */
  public function setImages(array $images)
  {
    $this->images = $images;

    return $this;
  }

  /**
   * Get created_at
   *
   * @return  string
   */
  public function getCreated_at()
  {
    return $this->created_at;
  }

  /**
   * Set created_at
   *
   * @param  string  $created_at  created_at
   *
   * @return  self
   */
  public function setCreated_at(string $created_at)
  {
    $this->created_at = $created_at;

    return $this;
  }

  /**
   * Get updated_at
   *
   * @return  string
   */
  public function getUpdated_at()
  {
    return $this->updated_at;
  }

  /**
   * Set updated_at
   *
   * @param  string  $updated_at  updated_at
   *
   * @return  self
   */
  public function setUpdated_at(string $updated_at)
  {
    $this->updated_at = $updated_at;

    return $this;
  }
}
