<?php

namespace App\Boutique\Models;

use JsonSerializable;

class Orders implements JsonSerializable
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * basket
     *
     * @var bool
     */
    private $basket;

    /**
     * status
     *
     * @var string
     */
    private $status;

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

    /**
     * users_id
     *
     * @var int
     */
    private $users_id;

    /************************************************* Other Properties */

    /**
     * full_name
     *
     * @var string
     */
    private $full_name;

    /**
     * email
     *
     * @var string
     */
    private $email;
    /* ----------------------------------- CONSTRUCTOR ------------------------------ */

    function __construct(array $data = [])
    {
        foreach($data as $key => $property){
            if (property_exists($this, $key)){
                $this->{$key} = $property;
            }
        }
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

    /* ----------------------------------- GETTER / SETTER ------------------------------ */

    /**
     * Get id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param  int  $id  id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get basket
     *
     * @return  int
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * Set basket
     *
     * @param  int  $basket  basket
     *
     * @return  self
     */
    public function setBasket(int $basket)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Get status
     *
     * @return  string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set status
     *
     * @param  string  $status  status
     *
     * @return  self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

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

    /************************************************* Other SETTER/GETTER  *************************************/

    /**
     * Get email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param  string  $email  email
     *
     * @return  self
     */
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get full_name
     *
     * @return  string
     */
    public function getFull_name()
    {
        return $this->full_name;
    }

    /**
     * Set full_name
     *
     * @param  string  $full_name  full_name
     *
     * @return  self
     */
    public function setFull_name(string $full_name)
    {
        $this->full_name = $full_name;

        return $this;
    }
}
