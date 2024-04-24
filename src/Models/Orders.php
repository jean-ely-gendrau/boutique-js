<?php

namespace App\Boutique\Models;

class Orders
{
    public $id_order;
    public $id_user;
    public $id_product;
    public $basket;
    public $status;
    public $created_at;
    public $updated_at;

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
