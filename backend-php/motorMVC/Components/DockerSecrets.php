<?php

namespace Motor\Mvc\Components;

use Motor\Mvc\Enum\ExceptionEnum;
use Stripe\Stripe;
use Motor\Mvc\Enum\SecretsEnum;
use Motor\Mvc\Exceptions\MotorMvcException;

class DockerSecrets
{

  /**
   * Method getSecrets
   *
   *  Valeur possible pour $case
   * 
   *  Api_Key_Stripe;
   *  Name_BDD;
   *  Host_BDD;
   *  User_BDD;
   *  Password_BDD;
   *  Port_BDD;
   *  Charset_BDD;
   * 
   * Si vous ajoutez un nouveau secret ajouté la clé à SecretsEnum
   * @param SecretsEnum $case [Clé du secret]
   *
   * @return string
   */
  public static function getSecrets(SecretsEnum $case): string
  {
    $secretValue = false;

    if (file_exists("/run/secrets/{$case->value}")) {
      $secretValue = file_get_contents("/run/secrets/{$case->value}", true);
    }

    if (!$secretValue) {
      throw new MotorMvcException(ExceptionEnum::SecretsNotFound);
    }

    return $secretValue;
  }
}
