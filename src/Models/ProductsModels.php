<?php

namespace App\Boutique\Models;

use JsonSerializable;

class ProductsModels implements JsonSerializable
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * name
     *
     * @var string
     */
    private $name;

    /**
     * description
     *
     * @var string
     */
    private $description;

    /**
     * price
     *
     * @var float
     */
    private $price;

    /**
     * quantity
     *
     * @var int
     */
    private $quantity;

    /**
     * category_id
     *
     * @var int
     */
    private $category_id;

    /**
     * sub_category_id
     *
     * @var int
     */
    private $sub_category_id;

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
     * url_images
     *
     * @var string
     */
    private $url_image;

    /************************************************* Other Properties */

    // CAT SUBCAT NAME

    /**
     * catName
     *
     * @var string
     */
    private $catName;

    /**
     * subCatName
     *
     * @var string
     */
    private $subCatName;

    public function __construct()
    {
        //Ajouté les propriétés et méthodes au besoins
    }

    /* ----------------------------------- METHOD MAGIC ------------------------------ */
    /* __get magic
     * https://www.php.net/manual/en/language.oop5.magic.php
     */

    public function __get(string $name)
    {
        return $this->$name;
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

    /************************************** Getter/Setter ***********************************/

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
    public function setName(string $name)
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
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get price
     *
     * @return  float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price
     *
     * @param  float  $price  price
     *
     * @return  self
     */
    public function setPrice(float $price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return  int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set quantity
     *
     * @param  int  $quantity  quantity
     *
     * @return  self
     */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;

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
     * @param  string  $url_image
     *
     * @return  self
     */
    public function setUrl_image(string $url_image)
    {
        $this->url_image = $url_image;

        return $this;
    }

    public function jsonSerialize(): mixed
    {
        // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
        return get_object_vars($this);
    }
}
