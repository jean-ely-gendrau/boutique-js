<?php

namespace App\Boutique\Models\Special;

use JsonSerializable;

class CategorySubCat implements JsonSerializable
{
  /**
   * idCat
   *
   * @var int
   */
  private $idCat;

  /**
   * nameCat
   *
   * @var string
   */
  private $nameCat;

  /**
   * descriptionCat
   *
   * @var string
   */
  private $descriptionCat;

  /**
   * idSubCat
   *
   * @var int
   */
  private $idSubCat;

  /**
   * nameSubCat
   *
   * @var string
   */
  private $nameSubCat;

  /**
   * descriptionSubCat
   *
   * @var string
   */
  private $descriptionSubCat;

  public function __construct()
  {
    /* Action du contructure au besoins */
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

  /**************************************** Getter/Setter **********************************************/



  /* ----------------------------------- implements jsonSerialize ------------------------------ */
  /**
   * Method jsonSerialize
   *
   * Cette méthode retourne les propriétés de la classe sous forme de tableau
   * Cela permet l'encodage avec json_endode des propriétés privées.
   *
   * @return mixed
   */
  public function jsonSerialize(): mixed
  {
    // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
    return get_object_vars($this);
  }

  /**
   * Get idCat
   *
   * @return  int
   */
  public function getIdCat()
  {
    return $this->idCat;
  }

  /**
   * Set idCat
   *
   * @param  int  $idCat  idCat
   *
   * @return  self
   */
  public function setIdCat(int $idCat)
  {
    $this->idCat = $idCat;

    return $this;
  }

  /**
   * Get nameCat
   *
   * @return  string
   */
  public function getNameCat()
  {
    return $this->nameCat;
  }

  /**
   * Set nameCat
   *
   * @param  string  $nameCat  nameCat
   *
   * @return  self
   */
  public function setNameCat(string $nameCat)
  {
    $this->nameCat = $nameCat;

    return $this;
  }

  /**
   * Get descriptionCat
   *
   * @return  string
   */
  public function getDescriptionCat()
  {
    return $this->descriptionCat;
  }

  /**
   * Set descriptionCat
   *
   * @param  string  $descriptionCat  descriptionCat
   *
   * @return  self
   */
  public function setDescriptionCat(string $descriptionCat)
  {
    $this->descriptionCat = $descriptionCat;

    return $this;
  }

  /**
   * Get idSubCat
   *
   * @return  int
   */
  public function getIdSubCat()
  {
    return $this->idSubCat;
  }

  /**
   * Set idSubCat
   *
   * @param  int  $idSubCat  idSubCat
   *
   * @return  self
   */
  public function setIdSubCat(int $idSubCat)
  {
    $this->idSubCat = $idSubCat;

    return $this;
  }

  /**
   * Get nameSubCat
   *
   * @return  string
   */
  public function getNameSubCat()
  {
    return $this->nameSubCat;
  }

  /**
   * Set nameSubCat
   *
   * @param  string  $nameSubCat  nameSubCat
   *
   * @return  self
   */
  public function setNameSubCat(string $nameSubCat)
  {
    $this->nameSubCat = $nameSubCat;

    return $this;
  }

  /**
   * Get descriptionSubCat
   *
   * @return  string
   */
  public function getDescriptionSubCat()
  {
    return $this->descriptionSubCat;
  }

  /**
   * Set descriptionSubCat
   *
   * @param  string  $descriptionSubCat  descriptionSubCat
   *
   * @return  self
   */
  public function setDescriptionSubCat(string $descriptionSubCat)
  {
    $this->descriptionSubCat = $descriptionSubCat;

    return $this;
  }
}
