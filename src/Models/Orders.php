<?php

namespace App\Boutique\Models;

class Users
{
    private $id_order;
    private $id_user;
    private $id_product;
    private $basket;
    private $status;

    function __construct()
    {
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
    }
}
