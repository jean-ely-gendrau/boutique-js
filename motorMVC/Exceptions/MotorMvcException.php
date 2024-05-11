<?php

namespace Motor\Mvc\Exceptions;

use Motor\Mvc\Enum\ExceptionEnum;

class MotorMvcException extends \Exception
{

  function __construct(private ExceptionEnum $case)
  {
    match ($case) {
      ExceptionEnum::TemplateNotFound   =>  parent::__construct("Ooops le template que vous demandez est introuvable.", 404),
    };
  }
}
