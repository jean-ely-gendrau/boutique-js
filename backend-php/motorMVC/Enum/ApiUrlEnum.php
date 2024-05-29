<?php

namespace Motor\Mvc\Enum;

enum ApiUrlEnum: string
{
  case Node_Jwt = "http://node-jwt:3555";
  case Node_Service = "http://node:9999";
}
