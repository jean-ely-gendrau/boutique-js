<?php

namespace App\Cinetech\Components;

use Motor\Mvc\Enum\ApiUrlEnum;
use Psr\Http\Message\StreamInterface;


class GruzzelRequest
{
  /**
   * Method requestGZ
   *
   * @param ApiUrlEnum $case [Node_Jwt,Node_Service, une valeur de l'énumartion ApiUrlEnum correspondant à l'API avec laquelle communiquer ]
   * @param string $endpoint [endpoint de l'api]
   *
   * @return false
   */
  public static function requestGZ(ApiUrlEnum $case, string $endpoint): false|StreamInterface
  {
    $client = new \GuzzleHttp\Client();

    try {
      $response = match ($case) {
        ApiUrlEnum::Node_Jwt => $client->request('GET', "http://" . ApiUrlEnum::Node_Jwt->value . "/{$endpoint}"),
      };

      return $response->getBody();
    } catch (\GuzzleHttp\Exception\BadResponseException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();

      return false;
    }
  }
}
