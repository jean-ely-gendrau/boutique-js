<?php

namespace Motor\Mvc\Interfaces;

interface Response
{
    /**
     * **Method JsonD**
     *
     *  * Cette méthode transforme et retourne un string en un objet Json stdClass
     *  * Si $boolAssoc vaut true alors les données seront retournée sous forme de tableau associatif
     *
     * @param string $data [Les datas string json à décoder]
     * @param ?bool $boolAssoc [True si les données doivent être retourner sous forme de tableau assosiatif]
     *
     * @return object
     */
    public static function JsonD(string $data, ?bool $boolAssoc = null): object;
}

/*
*
  Exemple d'implémentation de la méthod Text dans une class.

  class VotreClass implements ResponseJsonD
  ...

   /*
  public static function JsonD(mixed $data, ?bool $boolAssociative = null): object
  {

    return json_decode($data, $boolAssociative) ?: throw new \Exception('OooPs une erreur dans le traitement viens de ce produire');
  }
  ...

  public function yourMethod(){
    $result = self::JsonD($data);
  }

*/
