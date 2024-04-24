<?php

namespace App\Boutique\Models;

class Orders
{
    private $id_order;
    private $id_user;
    private $id_product;
    private $basket;
    private $status;
    private $created_at;
    private $updated_at;

    function __construct(?array $data = null)
    {
        $this->id_order = $data['id_order'] ?? '';
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
    }
}
