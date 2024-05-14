<?php

namespace Motor\Mvc\Interfaces;

interface ResponseJson
{
    /**
     * **Method Json**
     *
     *    * Cette méthode retorune un objet Json encodé au format string ou une Execption si json_encode retourne false.
     *
     * @param mixed $data [explicite description]
     * @param int $constantFormat [Passé une constante de formatage du Json, JSON_PRETTY_PRINT est prédefini par défault]
     *
     * @return string|\Exception
     */

    public static function Json(mixed $data, int $constantFormat = JSON_PRETTY_PRINT): string|\Exception;
}

/*
*
    Exemple d'implémentation de la méthod Text dans une class.

  class VotreClass implements ResponseJson

   /*
  public static function Json(mixed $data, int $constantFormat = JSON_PRETTY_PRINT): object
  {

    return json_encode($data, $constantFormat) ?: throw new \Exception('OooPs une erreur dans le traitement viens de ce produire');
  }
  ...

  public function yourMethod(){
    $result = self::JsonE($data);
  }
*/
