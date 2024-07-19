<?php

namespace App\Boutique\EntityManager;

use App\Boutique\Models\ProductsModels;
// use Motor\Mvc\Manager\CrudApi;
use Motor\Mvc\Manager\CrudManager;

class SearchEntity extends CrudManager
{
    public function __construct()
    {
        parent::__construct('Products', ProductsModels::class);
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }

    public function __set(string $property, mixed $value)
    {
    }

    public function searchProductsLike(string $name)
    {

     
        $connect = $this->_dbConnect;

        $req = $connect->prepare("SELECT name FROM `products` WHERE LOWER(CONVERT(name USING utf8mb4)) LIKE LOWER(CONVERT(:name USING utf8mb4)) LIMIT 10");

        $req->execute([':name' => '%'.$name.'%']);
        $req->setFetchMode(\PDO::FETCH_ASSOC);
        
        return $req->fetchAll();
        
    }
}
