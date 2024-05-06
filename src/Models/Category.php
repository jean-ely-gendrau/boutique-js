<?php

namespace App\Boutique\Models;

use JsonSerializable;

class Category implements JsonSerializable
{
    /**
     * id
     *
     * @var mixed
     */
    private $id;

    /**
     * name
     *
     * @var mixed
     */
    private $name;

    /**
     * description
     *
     * @var mixed
     */
    private $description;

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
     * @param  mixed  $id  id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
    public function setName($name)
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
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
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
}
