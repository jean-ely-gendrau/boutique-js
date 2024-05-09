<?php

namespace App\Boutique\Models;

class Ratings
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * rating
     *
     * @var int
     */
    private $rating;

    /**
     * products_id
     *
     * @var int
     */
    private $products_id;

    /**
     * users_id
     *
     * @var int
     */
    private $users_id;

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
}
