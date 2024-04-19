<?php
namespace App\Boutique\Models;

class ProductsAlex
{
    private $id_product;
    private $name;
    private $descritpion;
    private $price;
    private $quantity;
    private $images;
    private $id_category;
    private $id_sub_cat;
    private $created_at;
    private $updated_at;

    function __construct(?array $data = null)
    {
        $this->id_order = $data['id_product'] ?? '';
        $this->images = $data['images'] ?? '';
        $this->name = $data['name'] ?? '';
    }

    function __get($name)
    {
        return $this->$name;
    }
    function __set($name, $value)
    {
    }
}

?>
