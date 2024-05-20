<?php

namespace App\Boutique\Controllers;

class JWTController
{

    public $accesAPI;

    public function __construct()
    {
    }

    public function jwt(...$arguments)
    {
        $token = $_COOKIE['token'];

        $secret = $_COOKIE['secret'];

        if (!empty($token) && !empty($secret)) {
            return $accesAPI = true;
        } else {
            header('Location: /connexion');
            return $accesAPI = false;
        }
    }
}
