<?php

namespace App\Boutique\Models\Special;

use App\Boutique\Validators\ValidatorData;
use Motor\Mvc\Manager\PasswordHashManager;

class UsersConnect extends PasswordHashManager implements \JsonSerializable
{
  protected const EXCLUDE_PROPERTIES = ['password'];

  /**
   * email
   *
   * @var string
   */
  #[ValidatorData('email')]
  private $email;

  /**
   * password
   *
   * @var string
   */
  #[ValidatorData('password')]
  private $password;


  /**
   * Method __construct
   *
   * @param ?array $data [Les données du formulaire sous forme de tableau ce paramètre est facultatif]
   *
   * @return void
   */
  public function __construct(?array $data = null)
  {
    $this->email = $data['email'] ?? '';
    $this->password = $data['password'] ?? '';
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
    return array_diff_key(get_object_vars($this), array_flip(self::EXCLUDE_PROPERTIES));
  }

  public function json()
  {
    return [
      "email" => $this->email,
    ];
  }


  /* ----------------------------------- GETTER / SETTER ------------------------------ */

  /**
   * Get the value of email
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of password
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }
}
