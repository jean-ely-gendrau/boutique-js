<?php

namespace App\Boutique\Exceptions;

use App\Boutique\Enum\ClientExceptionEnum;

class ClientExceptions extends \Exception
{

  function __construct(private ClientExceptionEnum $case)
  {
    match ($case) {
      ClientExceptionEnum::NotFound404   =>  parent::__construct("Ooops la page que vous souhaitez consulter est introuvable.", 404),
      ClientExceptionEnum::AccountIsRegistered   =>  parent::__construct("Compte deja enregistre avec ce mail.", 401),
      ClientExceptionEnum::KeyNotFound   =>  parent::__construct("Paiement inaccessible.", 401),
      ClientExceptionEnum::CookieNotFound   =>  parent::__construct("Problème de cookie.. Vérifier vos paramètres ou réessayer ultérieurement.", 401),
    };
  }
}
