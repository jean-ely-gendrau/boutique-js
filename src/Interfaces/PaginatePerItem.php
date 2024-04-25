<?php

namespace App\Boutique\Interfaces;

interface PaginatePerItem
{

  /**
   *  **Method paginatePerItem**
   *  * Cette méthode retourne un tableau des éléments de paginations des résultats par  item
   * 
   *  * ['total_result' => $numberOfRows,  'item_last' => $itemLast, 'item_page' => $itemPerPage];
   * @param int $numberOfRows [nombre de résultats à paginer]
   * @param int $itemLast [item prochain à sélectionner dan la table]
   * @param int $page [page en cours de navigation]
   * @param int $itemPerPage [Nombre d'élément par page]
   *
   * @return array
   */
  public function paginatePerItem(int $numberOfRows, int $itemLast, int $page, int $itemPerPage): array;
}
