<?php

namespace App\Cinetech\Components;


class GruzzelRequest
{
  public static function requestGZ($endpoint)
  {
    $client = new \GuzzleHttp\Client();

    try {
      $response = $client->request('GET', "http://node:8887{$endpoint}");

      return $response->getBody();
    } catch (\GuzzleHttp\Exception\BadResponseException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();

      return false;
    }
  }
}
