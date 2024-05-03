<?php

namespace App\Boutique\Models;

use JsonSerializable;

class Orders implements JsonSerializable
{
    private $id;
    private $user_id;
    private $basket;
    private $status;
    private $created_at;
    private $updated_at;
    /**
     * name
     *
     * @var string
     */
    private $name;
    /**
     * price
     *
     * @var float
     */
    private $price;
    /**
     * id
     *
     * @var string
     */
    private $url_image;

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

    public function jsonSerialize(): mixed
    {
        // array_diff_key et EXCLUDE_PROPERTIES permettent de retirer des clés du résultat que l'on ne souhaite pas renvoyer.
        return get_object_vars($this);
    }
}
