<?php

namespace App\Boutique\Manager;


use App\Boutique\Manager\BddManager;
use App\Boutique\Interfaces\ResponseJson;
use App\Boutique\Interfaces\PaginatePerItem;
use App\Boutique\Interfaces\PaginatePerPage;

class CrudApi extends BddManager implements ResponseJson, PaginatePerPage, PaginatePerItem
{

  private string $_tableName;

  private string $_objectClass;

  protected object $_dbConnect;

  protected int $itemPerPage;

  protected int $itemStart;

  protected int $itemNext;

  /**
   * Method __construct CrudApi
   *
   * @param string $tableName [nom de la table]
   * @param string $objectClass [La class representant les données de la requête]
   * @param int $itemPerPage [nombre d'éléments à afficher par page]
   * @param int $itemStart [1 er résultat à séléctionner]
   * @param ?object $configDatabase [configuration de la  base de données]
   *
   * @return void
   */
  public function __construct(
    string $tableName,
    string $objectClass,
    int $itemPerPage = 5,
    int $itemStart = 0,
    ?object $configDatabase = null,
  ) {
    parent::__construct($configDatabase);
    $this->_tableName = $tableName;
    $this->_objectClass = $objectClass;
    $this->_dbConnect = $this->linkConnect();
    $this->itemPerPage = $itemPerPage;
    $this->itemStart = $itemStart;
    $this->itemNext = $itemStart + $itemPerPage - 1;
  }

  /********************************************** Méthode de L'API */
  /**
   * Method getAll
   *
   * @params array $select [les collones à séléctionner | si null toutes les collones seront extraite]
   * @return string|array
   */
  public function getAllPaginate(?array $select = null, bool $returnJson = false): string|array
  {
    $selectItem = is_null($select) ? '*' : join(', ', $select);

    $sql = 'SELECT ' . $selectItem . ' FROM ' . $this->_tableName . ' LIMIT :itemn';
    $req = $this->_dbConnect->prepare($sql);
    $req->execute(['itemn' => 5]);
    $req->setFetchMode(
      \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
      $this->_objectClass,
    );
    // self::paginatePerItem();
    return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
  }

  /***************************************************** Implements Response */


  public static function Json(mixed $data, int $constantFormat = JSON_PRETTY_PRINT): string|\Exception
  {

    return json_encode($data, JSON_PRETTY_PRINT) ?: throw new \Exception('OooPs une erreur dans le traitement viens de ce produire');
  }

  /***************************************************** Implements PaginatePerPage */

  public static function paginatePerPage(int $numberOfRows, int $itemPerPage): array
  {
    $numberPages = ceil($numberOfRows / $itemPerPage - 1);
    $pageLast = 0;
    $pageNext = 0;
    return ['total_result' => $numberOfRows, 'number_pages' => $numberPages, 'page_last' => $pageLast, 'page_next' => $pageNext];
  }


  public static function  paginatePerItem(int $numberOfRows, int $itemLast, int $page, int $itemPerPage): array
  {
    $itemLast = 0;
    $itemPerPage = 0;
    return ['total_result' => $numberOfRows,  'item_last' => $itemLast, 'item_page' => $itemPerPage];
  }

  /********************************************** Getter/Setter *****************************/

  /**
   * Get the value of itemStart
   */
  public function getItemStart()
  {
    return $this->itemStart;
  }

  /**
   * Set the value of itemStart
   *
   * @return  self
   */
  public function setItemStart($itemStart)
  {
    $this->itemStart = $itemStart;

    return $this;
  }

  /**
   * Get the value of itemNext
   */
  public function getItemNext()
  {
    return $this->itemNext;
  }

  /**
   * Set the value of itemNext
   *
   * @return  self
   */
  public function setItemNext($itemNext)
  {
    $this->itemNext = $itemNext;

    return $this;
  }


  /**
   * Get the value of itemPerPage
   */
  public function getItemPerPage()
  {
    return $this->itemPerPage;
  }

  /**
   * Set the value of itemPerPage
   *
   * @return  self
   */
  public function setItemPerPage($itemPerPage)
  {
    $this->itemNext = $this->itemStart + $itemPerPage - 1;

    return $this;
  }
}
