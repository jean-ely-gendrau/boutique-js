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
   * @return false|StreamInterface
   */
  public static function requestGZ(ApiUrlEnum $case, string $endpoint): false|StreamInterface
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
  public static function requestJWT(): false|StreamInterface
  {
    $client = new \GuzzleHttp\Client();

    try {
      $jar = new \GuzzleHttp\Cookie\CookieJar;
      $response = $client->request('POST', ApiUrlEnum::Node_Jwt->value . "/jwtsign", [
        'cookies' => $jar::fromArray($_COOKIE, $_SERVER['HTTP_HOST'])
      ]);

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
}
