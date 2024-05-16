<?php

namespace App\Controllers;

class JWTController
{

    public function __construct()
    {
    }

    public function jwt($request, $response)
    {
        $token = $_COOKIE['token'];

        $secret = $_COOKIE['secret'];

        if (!empty($token) && !empty($secret)) {
            return $response->withStatus(200)->withJson(['message' => 'Access granted']);
        } else {
            return $response->withStatus(401)->withJson(['message' => 'Access denied']);
        }
    }
}
