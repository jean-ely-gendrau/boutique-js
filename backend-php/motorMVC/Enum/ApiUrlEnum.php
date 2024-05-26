<?php

namespace Motor\Mvc\Enum;

enum ApiUrlEnum: string
{
  case Node_Jwt = "http://teaCoffee.dock:8882";
  case Node_Service = "http://teaCoffee.dock:8881";
}
