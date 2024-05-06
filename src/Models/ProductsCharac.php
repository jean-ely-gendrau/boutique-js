<?php

class ProductsCharac
{
    /**
     * value
     *
     * @var string
     */
    private $value;

    /**
     * charac_id
     *
     * @var int
     */
    private $charac_id;

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
     * Get value
     *
     * @return  string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param  string  $value  value
     *
     * @return  self
     */
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get charac_id
     *
     * @return  int
     */
    public function getCharac_id()
    {
        return $this->charac_id;
    }

    /**
     * Set charac_id
     *
     * @param  int  $charac_id  charac_id
     *
     * @return  self
     */
    public function setCharac_id(int $charac_id)
    {
        $this->charac_id = $charac_id;

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
