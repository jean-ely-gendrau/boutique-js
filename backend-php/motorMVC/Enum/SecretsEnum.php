<?php

namespace Motor\Mvc\Enum;

enum SecretsEnum: string
{
  case Api_Key_Stripe = 'api_key_stripe';
  case Name_BDD = 'database_mysql';
  case Dsn_BDD = 'dsn_mysql';
  case Host_BDD = 'host_mysql';
  case User_BDD = 'user_mysql';
  case Password_Root_BDD = 'password_root_mysql';
  case Port_BDD = 'port_mysql';
  case Charset_BDD = 'charset_mysql';
}
