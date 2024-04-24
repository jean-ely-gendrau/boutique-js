<?php

namespace App\Boutique\Models;

use JsonSerializable;

class Category implements JsonSerializable
{

  /**
   * id_category
   *
   * @var mixed
   */
  private  $id_category;

  /**
   * name
   *
   * @var mixed
   */
  private  $name;

  /**
   * description
   *
   * @var mixed
   */
  private  $description;



  public function __construct()
  {
    /* Action du contructure au besoins */
  }


  /**************************************** Getter/Setter **********************************************/

  /**
   * Get id_category
   *
   * @return  mixed
   */
  public function getId_category()
  {
    return $this->id_category;
  }

  /**
   * Set id_category
   *
   * @param  mixed  $id_category  id_category
   *
   * @return  self
   */
  public function setId_category($id_category)
  {
    $this->id_category = $id_category;

    return $this;
  }

  /**
   * Get name
   *
   * @return  mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set name
   *
   * @param  mixed  $name  name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get description
   *
   * @return  mixed
   */
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set description
   *
   * @param  mixed  $description  description
   *
   * @return  self
   */
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  public function jsonSerialize(): mixed
  {
    // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
    return array_diff_key(get_object_vars($this));
  }
}
