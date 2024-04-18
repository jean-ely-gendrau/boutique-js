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
    public function __construct(string $tableName, string $objectClass, $configDatabase = null)
    {
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
     * @param string $idTable [id de la table (ex: id_order)]
     *
     * @return object|bool
     */
    public function getById(string $id, string $idTable): object|bool
    {
        $req = $this->_dbConnect->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE ' . $idTable . ' = :id');
        $req->execute(['id' => intval($id)]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

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
        $req = $this->_dbConnect->prepare("SELECT {$selectItem} FROM " . $this->_tableName);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

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

        $sql =
            'UPDATE ' .
            $this->_tableName .
            ' SET ' .
            $valueString .
            ' WHERE ' . $param[0] . ' = :id_user';

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
        var_dump($boundParam);
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
        $adresse = $adresse->fetch()['adress'];

        $sql = "SELECT * FROM orders o JOIN products p ON o.id_product = p.id_product WHERE id_user = :client_id AND o.basket != 1";
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
                'status' => $row['status']
            ];
        }

        return $orders;
    }

    public function getbyidbasket($clientId)
    {
        $sql = "SELECT * FROM orders o JOIN products p ON o.id_product = p.id_product WHERE id_user = :client_id AND o.basket = 1";
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
                'status' => $row['status']
            ];
        }

        return $orders;
    }
}
