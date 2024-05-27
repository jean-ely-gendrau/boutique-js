<?php

namespace Motor\Mvc\Components;

use Motor\Mvc\Enum\ApiUrlEnum;
use \Psr\Http\Message\StreamInterface;


class GruzzelRequest
{
  /**
   * Method requestGZ
   *
   * @param ApiUrlEnum $case [Node_Jwt,Node_Service, une valeur de l'énumartion ApiUrlEnum correspondant à l'API avec laquelle communiquer ]
   * @param string $endpoint [endpoint de l'api]
   *
   * @return false|string|StreamInterface
   */
  public static function requestGZ(ApiUrlEnum $case, string $endpoint): false|string|StreamInterface
  {
    $client = new \GuzzleHttp\Client();

    try {
      $response = match ($case) {
        ApiUrlEnum::Node_Jwt => $client->request('GET', ApiUrlEnum::Node_Jwt->value . "/{$endpoint}"),
      };

      return $response->getBody();
    } catch (\GuzzleHttp\Exception\ConnectException $e) {
      return false;
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      return false;
    } catch (\GuzzleHttp\Exception\BadResponseException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();

      return false;
    }
  }
  public static function requestJWT()
  {
    $client = new \GuzzleHttp\Client();

    try {
      $response = $client->request('POST', ApiUrlEnum::Node_Jwt->value . "/jwt-token", [
        'form_params' => [
          'email' => $_SESSION['email']
        ]
      ]);

      return json_decode($response->getBody());
    } catch (\GuzzleHttp\Exception\ConnectException $e) {
      return false;
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      return "request";
    } catch (\GuzzleHttp\Exception\BadResponseException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();

      return false;
    }
  }
}
