<?php

namespace App\Boutique\Models\Fixtures;

class UsersProfile
{
    protected $id;
    protected $first_name;
    protected $last_name;
    protected $full_name;
    protected $birthday;
    protected $email;
    protected $gender;
    protected $ip_address;

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
?>
