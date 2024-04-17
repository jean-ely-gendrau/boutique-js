<?php

namespace App\Boutique\Interfaces;


interface Response
{

  /**
   * **Method Text**
   *  * Cette méthode retourne tout résultats sous format text
   * 
   * * Paramètres
   * @param mixed $data [Les données à afficher sous forme de chaîne de caractère]
   *
   * @return string
   */
  public static function Text(mixed $data): string;
}

/*
  Exemple d'implémentation de la méthod Text dans une class.

  class VotreClass implements Response
  ...

   /*
  public static function Text(mixed $data): string
  {

    return is_array($data) || is_object($data) ? join(PHP_EOL, (array) array_values($data)) : $data;
  }
  ...

  public function yourMethod(){
    $result = self::Text($data);
  }
  */