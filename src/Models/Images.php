<?php

class Images
{
    /**
     * id
     *
     * @var int
     */
    private $id;

    /**
     * id
     *
     * @var bool
     */
    private $image_main;

    /**
     * id
     *
     * @var string
     */
    private $url_image;

    /**
     * id
     *
     * @var int
     */
    private $products_id;

    public function __construct()
    {
    }

    public function __get(string $name)
    {
        return $this->$name;
    }

    public function __set(string $property, mixed $value)
    {
    }
}
