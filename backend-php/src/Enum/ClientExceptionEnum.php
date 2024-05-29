<?php

namespace App\Boutique\Enum;

enum ClientExceptionEnum
{
  case NotFound404;
  case AccountIsRegistered;
  case KeyNotFound;
  case CookieNotFound;
}
