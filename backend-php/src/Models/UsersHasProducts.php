<?php

namespace App\Boutique\Models;

class UsersHasProducts
{
    /**
     * users_id
     *
     * @var int
     */
    private $users_id;

    /**
     * products_id
     *
     * @var int
     */
    private $products_id;

    public function __construct()
    {
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */

    /**
     * Get magic __get
     *
     * @return mixed
     */
    public function __get(string $name)
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

    /************************************** Getter/Setter ***********************************/

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

    /**
     * Get products_id
     *
     * @return  int
     */
    public function getProducts_id()
    {
        return $this->products_id;
    }

    /**
     * Set products_id
     *
     * @param  int  $products_id  products_id
     *
     * @return  self
     */
    public function setProducts_id(int $products_id)
    {
        $this->products_id = $products_id;

        return $this;
    }
}
