<?php

class ProductsOrders
{
    /**
     * orders_id
     *
     * @var int
     */
    private $orders_id;

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
     * Get orders_id
     *
     * @return  int
     */
    public function getOrders_id()
    {
        return $this->orders_id;
    }

    /**
     * Set orders_id
     *
     * @param  int  $orders_id  orders_id
     *
     * @return  self
     */
    public function setOrders_id(int $orders_id)
    {
        $this->orders_id = $orders_id;

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
