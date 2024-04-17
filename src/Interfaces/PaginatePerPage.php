<?php

namespace App\Boutique\Interfaces;

interface PaginatePerPage
{

  /**
   * **Method paginatePerPage**
   *
   *  * Cette méthode retourne un tableau des éléments de paginations des résultats par page
   * 
   *  * ['total_result' => $numberOfRows, 'number_pages' => $numberPages, 'page_last' => $pageLast, 'page_next' => $pageNext]
   * 
   * ##### Paramètres
   * @param int $numberOfRows [nombre de résultats à paginer]
   * @param int $itemPerPage [Nombre d'élément par page]
   *
   * @return array
   */
  public static function paginatePerPage(int $numberOfRows, int $itemPerPage): array;
}
