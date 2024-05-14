<?php

namespace App\Boutique\Exceptions;

use App\Boutique\Enum\ClientExceptionEnum;

class ClientExceptions extends \Exception
{

  function __construct(private ClientExceptionEnum $case)
  {
    match ($case) {
      ClientExceptionEnum::NotFound404   =>  parent::__construct("Ooops la page que vous souhaitez consulter est introuvable.", 404),
    };
  }
}
