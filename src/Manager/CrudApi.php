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

    protected int $page;

    protected int $limit;

    protected int $offset;

    protected int $offsetNext;
    /**
   * Method __construct CrudApi
   *
   * @param string $tableName [nom de la table]
   * @param string $objectClass [La class representant les données de la requête]

   * @param int $limit [nombre de résultat à séléctionner]
   * @param int $offset [1 er résultat à séléctionner]
   * @param ?object $configDatabase [configuration de la  base de données]
   *
   * @return void
   */
    public function __construct(string $tableName, string $objectClass, int $limit = 5, int $page = 1, ?object $configDatabase = null)
    {
        // Params BDD
        parent::__construct($configDatabase);
        $this->_tableName = $tableName;
        $this->_objectClass = $objectClass;
        $this->_dbConnect = $this->linkConnect();

        // Pagination
        $this->limit = $limit;
        $this->offset = $page === 1 ? 0 : $this->limit * $page;
        $this->offsetNext = $this->offset + 1;
    }

    /********************************************** Méthode de L'API */
    /**
     * Method getCountResult
     *
     * Cette méthode retourne le nombre d'enregistrement maximum de la table instancié
     *
     * @return array
     */
    public function getCountResult(): array
    {
        $sql = "SELECT COUNT(*) as numberOfRows FROM {$this->getTableName()} LIMIT 1";

        //Prépare
        $req = $this->_dbConnect->prepare($sql);
        $req->execute();

        // self::paginatePerItem();
        return $req->fetch();
    }

    /**
     * Method getAll
     *
     * @params array $select [les collones à séléctionner | si null toutes les collones seront extraite]
     * @return string|array
     */
    public function getAllPaginate(?array $select = null, bool $returnJson = false): string|array
    {
        $selectItem = is_null($select) ? '*' : join(', ', $select);

        $sql = "SELECT {$selectItem} FROM {$this->_tableName} LIMIT :limit OFFSET :offset";
        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        //Prépare
        $req = $connect->prepare($sql);
        $req->execute(['limit' => $this->limit, 'offset' => $this->offset]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);
        // self::paginatePerItem();
        return $returnJson ? self::Json($req->fetchAll()) : $req->fetchAll();
    }

    /***************************************************** Implements Response */

    public static function Json(mixed $data, int $constantFormat = JSON_PRETTY_PRINT): string|\Exception
    {
        return json_encode($data, JSON_PRETTY_PRINT) ?: throw new \Exception('OooPs une erreur dans le traitement viens de ce produire');
    }

    /***************************************************** Implements PaginatePerPage */

    public function paginatePerPage(int $page, int $itemPerPage): array
    {
        $numberOfRows = $this->getCountResult();

        $this->setPage($page);
        $this->setLimit($itemPerPage);
        $numberPages = (int) ceil($numberOfRows[0] / $itemPerPage);
        $pageLast = $page === 1 ? false : $page - 1;
        $pageNext = $page === $numberPages ? false : $page + 1;
        return ['total_result' => $numberOfRows[0], 'number_pages' => $numberPages, 'page_last' => $pageLast, 'page_next' => $pageNext];
    }

    public function paginatePerItem(int $numberOfRows, int $itemLast, int $page, int $itemPerPage): array
    {
        $itemLast = 0;
        $itemPerPage = 0;
        return ['total_result' => $numberOfRows, 'item_last' => $itemLast, 'item_page' => $itemPerPage];
    }

    /********************************************** Getter/Setter *****************************/

    /**
     * Get the value of _objectClass
     */
    public function getObjectClass()
    {
        return $this->_objectClass;
    }

    /**
     * Set the value of _objectClass
     *
     * @return  self
     */
    public function setObjectClass($_objectClass)
    {
        $this->_objectClass = $_objectClass;

        return $this;
    }

    /**
     * Get the value of _tableName
     */
    public function getTableName()
    {
        return $this->_tableName;
    }

    /**
     * Set the value of _tableName
     *
     * @return  self
     */
    public function setTableName($_tableName)
    {
        $this->_tableName = $_tableName;

        return $this;
    }

    /**
     * Get the value of page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set the value of page
     *
     * @return  self
     */
    public function setPage($page)
    {
        $this->page = $page;

        // Pagination
        $this->offset = $page === 1 ? 0 : $this->limit * $page;
        $this->offsetNext = $this->offset + 1;

        return $this;
    }

    /**
     * Get the value of limit
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * Set the value of limit
     *
     * @return  self
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;

        return $this;
    }
}
