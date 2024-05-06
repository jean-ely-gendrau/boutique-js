<?php

class Favoris
{
    /**
     * id
     *
     * @var int
     */
    private $id;

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
}
