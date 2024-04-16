<?php

namespace App\Boutique\Manager;

/**
 * CrudManager
 */
class CrudManager extends BddManager
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

    /**
     * Method __construct
     *
     * @param $tableName [nom de la table]
     * @param $objectClass [La class representant les données de la requête]
     * @param $configDatabase [configuration de la  base de données]
     *
     * @return void
     */
    public function __construct(
        string $tableName,
        string $objectClass,
        $configDatabase = null,
    ) {
        parent::__construct($configDatabase);
        $this->_tableName = $tableName;
        $this->_objectClass = $objectClass;
        $this->_dbConnect = $this->linkConnect();
    }

    /**
     * Method getConnectBdd
     *
     * Instance de la connection PDO
     *
     * @return void
     */
    public function getConnectBdd(): object
    {
        return $this->_dbConnect;
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
     * @return object
     */
    public function getById(string $id): object
    {
        $req = $this->_dbConnect->prepare(
            'SELECT * FROM ' . $this->_tableName . ' WHERE id = :id',
        );
        $req->execute(['id' => intval($id)]);
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            $this->_objectClass,
        );

        return $req->fetch();
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
        $req = $this->_dbConnect->prepare(
            "SELECT {$selectItem} FROM " . $this->_tableName,
        );
        $req->execute();
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            $this->_objectClass,
        );

        return $req->fetchAll();
    }

    /**
     * Method getByEmail
     *
     * @param string $email [email de correspondance]
     *
     * @return bool | object
     */
    public function getByEmail(string $email): bool | object
    {
        $req = $this->_dbConnect->prepare(
            'SELECT * FROM ' . $this->_tableName . ' WHERE email = :email',
        );
        $req->execute(['email' => $email]);
        $req->setFetchMode(
            \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
            $this->_objectClass,
        );

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

        $sql =
            'INSERT INTO ' .
            $this->_tableName .
            '(' .
            implode(', ', $param) .
            ') VALUES(' .
            $valueString .
            ')';
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
     * @param array $param [paramètre representant les données à metre à jour]
     *
     * @return mixed
     */
    public function update(object $objectClass, array $param): mixed
    {
        $valueString = self::formatParams($param, 'FORMAT_UPDATE');

        if (empty($valueString)) {
            echo "No valid parameters provided for update.";
            return null;
        }

        $sql =
            'UPDATE ' .
            $this->_tableName .
            ' SET ' .
            $valueString .
            ' WHERE id = :user_id';
        $req = $this->_dbConnect->prepare($sql);
        // $param = ['id'];
        $boundParam = [];

        foreach ($param as $paramName) {
            if (property_exists($objectClass, $paramName)) {
                $boundParam[$paramName] = $objectClass->$paramName;
            } else {
                echo "Une erreur est survenu lors de la mise à jour, veuillez verifier $paramName : $this->_objectClass";
            }
        }
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
            $req = $this->_dbConnect->prepare(
                'DELETE FROM ' . $this->_tableName . ' WHERE id=?',
            );

            return $req->execute([$objectClass->id]);
        } else {
            echo "Une erreur viens de ce produire lors de la suppression avec id: $this->_objectClass";
        }
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



        $adresse = $this->_dbConnect->prepare(
            'SELECT adress FROM users WHERE id_user = :client_id',
        );

        $adresse->execute(['client_id' => $clientId]);
        $adresse->setFetchMode(\PDO::FETCH_ASSOC);

        $sql = "SELECT * FROM orders o JOIN products p ON o.id_product = p.id_product WHERE id_user = :client_id AND o.basket != 1";
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':client_id' => $clientId]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $status = $stmt->fetch()['status'];
        $id_product = $stmt->fetch()['id_product'];


        $price_product = $this->_dbConnect->prepare(
            'SELECT price FROM products WHERE id_product = :id_product',
        );
        $price_product->execute(['id_product' => $id_product]);
        $price_product->setFetchMode(\PDO::FETCH_ASSOC);

        $product_name = $this->_dbConnect->prepare(
            'SELECT name FROM products WHERE id_product = :id_product',
        );
        $product_name->execute(['id_product' => $id_product]);
        $product_name->setFetchMode(\PDO::FETCH_ASSOC);

        $adresse = $adresse->fetch()['adress'];
        $price_product = $price_product->fetch()['price'];
        $product_name = $product_name->fetch()['name'];


        $orders = [];

        while ($row = $stmt->fetch()) {
            $orders[] = [
                'client_id' => $clientId,
                'product_name' => $row['name'],
                'adress' => $adresse,
                'price' => $row['price'],
                'status' => $row['status']
            ];
        }

        return $orders;
    }
}
