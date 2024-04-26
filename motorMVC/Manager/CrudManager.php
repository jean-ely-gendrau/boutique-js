<?php

namespace Motor\Mvc\Manager;

use Motor\Mvc\Interfaces\PaginatePerPage;

/**
 * CrudManager
 */
class CrudManager extends BddManager implements PaginatePerPage
{
    /**
     * _tableName
     *
     * @var string
     */
    private $_tableName;

    /**
     * _objectClass
     *
     * @var string
     */
    private $_objectClass;

    /**
     * _dbConnect
     *
     * @var object
     */
    protected $_dbConnect;

    protected int $page;

    protected int $limit;

    protected int $offset;

    protected int $offsetNext;

    /**
     * Method __construct
     *
     * @param $tableName [nom de la table]
     * @param $objectClass [La class representant les données de la requête]
     * @param int $limit [nombre de résultat à séléctionner]
     * @param int $offset [1 er résultat à séléctionner]
     * @param $configDatabase [configuration de la  base de données]
     *
     * @return void
     */
    public function __construct(string $tableName, string $objectClass, int $limit = 5, int $page = 1, $configDatabase = null)
    {
        parent::__construct($configDatabase);
        $this->_tableName = $tableName;
        $this->_objectClass = $objectClass;
        $this->_dbConnect = $this->linkConnect();

        // Pagination
        $this->limit = $limit;
        $this->offset = $page === 1 ? 0 : $this->limit * $page;
        $this->offsetNext = $this->offset + 1;
    }

    /**
     * Method getConnectBdd
     *
     * @return object
     */
    public function getConnectBdd(): object
    {
        return $this->_dbConnect;
    }

    /**
     * Method getCountResult
     *
     * Cette méthode retourne le nombre d'enregistrement maximum de la table instancié
     *
     * @return array
     */
    public function getCountResult(): array
    {
        $sql = "SELECT COUNT(*) as numberOfRows FROM {$this->_tableName} LIMIT 1";

        //Prépare
        $req = $this->_dbConnect->prepare($sql);
        $req->execute();

        // self::paginatePerItem();
        return $req->fetch();
    }

    /** EXEMPLE DE Méthod
     * Method getByLike
     *
     *  @return array
   
    public function getByLike(mixed $search, string $columnLike): array
    {
        $req = $this->_dbConnect->prepare(
            'SELECT * FROM ' .
                $this->_tableName .
                " WHERE {$columnLike} LIKE :search AND JSON_CONTAINS(`jsonFood`, :json) LIMIT 10",
        );
        $req->execute($search);
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            $this->_objectClass,
        );

        return $req->fetchAll();
    }
     */

    /**
     * Method getById
     *
     * @param string $id [id de la requête]
     *
     *
     * @return object|bool
     */
    public function getById(string $id): object|bool
    {
        $req = $this->_dbConnect->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE id = :id');
        $req->execute(['id' => intval($id)]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetch();
    }

    /**
     * Method getAllById
     *
     * @param string $id [id de la requête]
     *
     *
     * @return array
     */
    public function getAllById(string $id, string $idTable): array
    {
        $req = $this->_dbConnect->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE id = :id');
        $req->execute(['id' => $id]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetchAll();
    }

    /**
     * Method getAll
     *
     * @params array $select [les collones à séléctionner | si null toutes les collones seront extraite]
     * @return array
     */
    public function getAll(?array $select = null): array
    {
        $selectItem = is_null($select) ? '*' : join(', ', $select);
        $req = $this->_dbConnect->prepare("SELECT {$selectItem} FROM " . $this->_tableName);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetchAll();
    }

    /**
     * Method getAllPaginate
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
        return $req->fetchAll();
    }

    /**
     * Method getByEmail
     *
     * @param string $email [email de correspondance]
     *
     * @return bool | object
     */
    public function getByEmail(string $email): bool|object
    {
        $req = $this->_dbConnect->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE email = :email');
        $req->execute(['email' => $email]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetch();
    }

    /**
     * Method create
     *
     * @param object $objectClass [object des données à créer dans la table]
     * @param array $param [paramètre representant les données à créer]
     *
     * @return mixed
     */
    public function create(object $objectClass, array $param): void
    {
        $valueString = self::formatParams($param, 'FORMAT_CREATE');

        $sql = 'INSERT INTO ' . $this->_tableName . '(' . implode(', ', $param) . ') VALUES(' . $valueString . ')';
        $req = $this->_dbConnect->prepare($sql);
        $boundParam = [];

        foreach ($param as $paramName) {
            if (property_exists($objectClass, $paramName)) {
                $boundParam[$paramName] = $objectClass->$paramName;
            } else {
                echo "Une erreur est survenu lors de la création, veuillez verifier $paramName : $this->_objectClass";
            }
        }
        $req->execute($boundParam);
    }

    /**
     * Method update
     *
     * @param object $objectClass [object des données à metre à jour dans la table]
     * @param array $param [paramètre representant les données à metre à jour - Le premier élément du tableau dois être la clé de id à mettre à jour exemple id,id_user,id_product ...]
     *
     * @return void
     */
    public function update(object $objectClass, array $param): void
    {
        // On mémorise les paramètres à mettre à jours
        $paramsUpdate = $param;
        unset($paramsUpdate[0]); // Supprime la clé 0 qui dois correspondre à exemple id,id_user,id_product...
        $valueString = self::formatParams($paramsUpdate, 'FORMAT_UPDATE'); // Préparation des paramètre de mise à jours

        $sql = 'UPDATE ' . $this->_tableName . ' SET ' . $valueString . ' WHERE id = :id';

        $req = $this->_dbConnect->prepare($sql);

        // Paramètre SQL execute
        $boundParam = [];

        // Parcours des paramètres à mettre à jour
        foreach ($param as $paramName) {
            // Si la proprété existe dans la class

            if (property_exists($objectClass, $paramName)) {
                $boundParam[$paramName] = $objectClass->$paramName; // On le défini dans le tableau avec sa clé
            } else {
                echo "Une erreur est survenu lors de la mise à jour, veuillez verifier $paramName : $this->_objectClass";
            }
        }
        // var_dump($boundParam);
        $req->execute($boundParam);
    }

    /**
     * Method delete
     *
     * @param object $objectClass [object des données à metre à jour dans la table]
     *
     * @return mixed
     */
    public function delete(object $objectClass): mixed
    {
        if (property_exists($objectClass, 'id')) {
            $req = $this->_dbConnect->prepare('DELETE FROM ' . $this->_tableName . ' WHERE id=?');

            return $req->execute([$objectClass->id]);
        } else {
            echo "Une erreur viens de ce produire lors de la suppression avec id: $this->_objectClass";
        }
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

    /************************************** GETTER/SETTER ************************************/

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

    /*------------------------------------ STATIC METHOD ------------------------------------*/

    /**
     * Method formatParams
     *
     * @param array $args [arguments de la requête à mettre en forme]
     * @param string $option [options de la methode de formatage FORMAT_CREATE | FORMAT_UPDATE]
     *
     * EXEMPLE : formatParams(array('username', 'password'), string $option)
     *
     *      FORMAT_CREATE -> :username, :password
     *      FORMAT_UPDATE -> username = :username, password = :password
     *
     * @return string
     */
    private static function formatParams(array $args, string $option): string
    {
        switch ($option):
            case 'FORMAT_CREATE':
                return join(
                    ', ',
                    array_map(function ($x) {
                        return ':' . $x;
                    }, $args),
                );

            case 'FORMAT_UPDATE':
                return join(
                    ', ',
                    array_map(function ($x) {
                        return $x . ' = :' . $x;
                    }, $args),
                );
        endswitch;
    }

    public function getByIdOrder($clientId)
    {
        $adresse = $this->_dbConnect->prepare('SELECT adress FROM users WHERE id = :client_id');
        $adresse->execute(['client_id' => $clientId]);
        $adresse->setFetchMode(\PDO::FETCH_ASSOC);
        $adresse = $adresse->fetch()['adress'];

        $sql = 'SELECT * FROM orders o JOIN products p ON o.id_product = p.id WHERE users_id = :client_id AND o.basket != 1';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':client_id' => $clientId]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $orders = [];

        while ($row = $stmt->fetch()) {
            $orders[] = [
                'client_id' => $clientId,
                'product_name' => $row['name'],
                'adress' => $adresse,
                'price' => $row['price'],
                'status' => $row['status'],
            ];
        }

        return $orders;
    }

    public function getbyidbasket($clientId)
    {
        $sql = 'SELECT * FROM orders o JOIN products p ON o.id_product = p.id_product WHERE id_user = :client_id AND o.basket = 1';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':client_id' => $clientId]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $orders = [];
        while ($row = $stmt->fetch()) {
            $orders[] = [
                'client_id' => $clientId,
                'id_product' => $row['id_product'],
                'images' => $row['images'],
                'product_name' => $row['name'],
                'price' => $row['price'],
                'status' => $row['status'],
            ];
        }

        return $orders;
    }
}
