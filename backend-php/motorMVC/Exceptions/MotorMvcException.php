<?php

namespace Motor\Mvc\Exceptions;

use Motor\Mvc\Enum\ExceptionEnum;

class MotorMvcException extends \Exception
{

  function __construct(private ExceptionEnum $case)
  {
    match ($case) {
      ExceptionEnum::TemplateNotFound   =>  parent::__construct("Ooops le template que vous demandez est introuvable.", 404),
      ExceptionEnum::SecretsNotFound   =>  parent::__construct("Ooops le secrets que vous demandez est introuvable.", 404),
      ExceptionEnum::ControllerNotFound   =>  parent::__construct("Ooops une erreur dans le nom de votre contrôleur ou de la méthode appelée.", 404),
    };
  }
}
