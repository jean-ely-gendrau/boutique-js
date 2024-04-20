<?php

namespace App\Boutique\Interfaces;

interface DebugInterface
{

  /**
   *  ### Method view
   * 
   *  *La méthode View affiche les données passées en argument indenté correctement*
   * 
   *  * Cela améliore la compréhension des données affichées à l'écran lors de vos teste.
   * 
   *  * Pour implémenter cette méthode Debug::view($data);
   * 
   * @param mixed $data [explicite description]
   *
   * @return void
   */
  public static function view(mixed $data);
}
