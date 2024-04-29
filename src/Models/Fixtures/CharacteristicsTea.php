<?php

namespace App\Boutique\Models\Fixtures;

class CharacteristicsTea
{
    protected $id;
    protected $name;

    public function __construct()
    {
    }

    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set(string $property, mixed $value)
    {
    }
}
