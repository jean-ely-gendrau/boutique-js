<?php

namespace App\Boutique\Models;

class ProductsImages
{
    /**
     * products_id
     *
     * @var int
     */
    private $products_id;

    /**
     * images_id
     *
     * @var int
     */
    private $images_id;

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

    /**
     * Get images_id
     *
     * @return  int
     */
    public function getImages_id()
    {
        return $this->images_id;
    }

    /**
     * Set images_id
     *
     * @param  int  $images_id  images_id
     *
     * @return  self
     */
    public function setImages_id(int $images_id)
    {
        $this->images_id = $images_id;

        return $this;
    }
}
