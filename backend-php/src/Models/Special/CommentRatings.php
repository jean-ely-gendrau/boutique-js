<?php

namespace App\Boutique\Models\Special;

use JsonSerializable;

class CommentRatings implements JsonSerializable
{
  /*** PROPERTIES RATINGS */
  /**
   * idRating
   *
   * @var int
   */
  private $idRating;

  /**
   * rating
   *
   * @var int
   */
  private $rating;

  /*** PROPERTIES COMMENTS */
  /**
   * comment_id
   *
   * @var int
   */
  private $comment_id;

  /**
   * comment
   *
   * @var int
   */
  private $comment;


  /*** PROPERTIES FOLLOW */

  /**
   * product_id
   *
   * @var int
   */
  private $product_id;
  /**
   * users_id
   *
   * @var int
   */
  private $users_id;

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
   * Get idRating
   *
   * @return  int
   */
  public function getIdRating()
  {
    return $this->idRating;
  }

  /**
   * Set idRating
   *
   * @param  int  $idRating  idRating
   *
   * @return  self
   */
  public function setIdRating(int $idRating)
  {
    $this->idRating = $idRating;

    return $this;
  }

  /**
   * Get rating
   *
   * @return  int
   */
  public function getRating()
  {
    return $this->rating;
  }

  /**
   * Set rating
   *
   * @param  int  $rating  rating
   *
   * @return  self
   */
  public function setRating(int $rating)
  {
    $this->rating = $rating;

    return $this;
  }

  /**
   * Get comment_id
   *
   * @return  int
   */
  public function getComment_id()
  {
    return $this->comment_id;
  }

  /**
   * Set comment_id
   *
   * @param  int  $comment_id  comment_id
   *
   * @return  self
   */
  public function setComment_id(int $comment_id)
  {
    $this->comment_id = $comment_id;

    return $this;
  }

  /**
   * Get comment
   *
   * @return  int
   */
  public function getComment()
  {
    return $this->comment;
  }

  /**
   * Set comment
   *
   * @param  int  $comment  comment
   *
   * @return  self
   */
  public function setComment(int $comment)
  {
    $this->comment = $comment;

    return $this;
  }

  /**
   * Get product_id
   *
   * @return  int
   */
  public function getProduct_id()
  {
    return $this->product_id;
  }

  /**
   * Set product_id
   *
   * @param  int  $product_id  product_id
   *
   * @return  self
   */
  public function setProduct_id(int $product_id)
  {
    $this->product_id = $product_id;

    return $this;
  }

  /**
   * Get users_id
   *
   * @return  int
   */
  public function getUsers_id()
  {
    return $this->users_id;
  }

  /**
   * Set users_id
   *
   * @param  int  $users_id  users_id
   *
   * @return  self
   */
  public function setUsers_id(int $users_id)
  {
    $this->users_id = $users_id;

    return $this;
  }
}
