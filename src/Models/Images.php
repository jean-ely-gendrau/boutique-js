<?php

namespace App\Boutique\Models;

class Images
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * image_main
     *
     * @var bool
     */
    private $image_main;

    /**
     * url_image
     *
     * @var string
     */
    private $url_image;

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
     * Get image_main
     *
     * @return  bool
     */
    public function getImage_main()
    {
        return $this->image_main;
    }

    /**
     * Set image_main
     *
     * @param  bool  $image_main  image_main
     *
     * @return  self
     */
    public function setImage_main(bool $image_main)
    {
        $this->image_main = $image_main;

        return $this;
    }

    /**
     * Get url_image
     *
     * @return  string
     */
    public function getUrl_image()
    {
        return $this->url_image;
    }

    /**
     * Set url_image
     *
     * @param  string  $url_image  url_image
     *
     * @return  self
     */
    public function setUrl_image(string $url_image)
    {
        $this->url_image = $url_image;

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
