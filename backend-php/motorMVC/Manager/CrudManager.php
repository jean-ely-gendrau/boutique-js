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

    protected object $model;

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
    public function __construct(string $tableName = null, string $objectClass = null, int $limit = 5, int $page = 1, $configDatabase = null)
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
     * Method getOneProduct : Retourne le produit par passe de l'id avec la jointure de l'url_image
     *
     * @param string $id [id de la requête]
     *
     *
     * @return object
     */
    public function getOneProduct(string $id): object
    {
        $req = $this->_dbConnect->prepare(
            'SELECT p.*, pi.products_id, i.url_image FROM products AS p 
            INNER JOIN productsimages pi ON p.id = pi.products_id 
            INNER JOIN images i ON pi.images_id = i.id 
            WHERE p.id = :id',
        );
        $req->execute(['id' => intval($id)]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetch();
    }

    /**
     * Method getAllProduct : Renvoi l'ensemble des produits avec la jointure de l'url_image
     *
     * @return array
     */
    public function getAllProduct(): array
    {
        // Désectivation ATTR_EMULATE_PREPARES
        // La désactivation permet de passer un booléen à la requête PDO et implémenter la pagination
        // Cela n'altère pas la sécurité
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        $req = $connect->prepare(
            "SELECT p.*, i.url_image
            FROM {$this->_tableName} p
            INNER JOIN productsimages pi ON p.id = pi.products_id
            INNER JOIN images i ON pi.images_id = i.id
            WHERE p.id = pi.images_id 
            LIMIT :limit OFFSET :offset",
        );
        $req->execute([':limit' => $this->limit, ':offset' => $this->offset]);
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetchAll();
    }

    /**
     * Method getAllByCategoryId : Retourne l'ensemble des produits par category avec la jointure de l'url_image
     *
     * @param string $category_id [category_id de la requête]
     *
     *
     * @return array
     */
    public function getAllByCategoryId(string $category_id): array
    {
        // Désectivation ATTR_EMULATE_PREPARES
        // La désactivation permet de passer un booléen à la requête PDO et implémenter la pagination
        // Cela n'altère pas la sécurité
        $connect = $this->_dbConnect;
        $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        $req = $connect->prepare(
            "SELECT p.*, pi.products_id, i.url_image FROM {$this->_tableName} AS p 
            INNER JOIN productsimages pi ON p.id = pi.products_id 
            INNER JOIN images i ON pi.images_id = i.id WHERE p.category_id = {$category_id} 
            LIMIT :limit OFFSET :offset",
        );
        $req->execute([':limit' => $this->limit, ':offset' => $this->offset]);
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
    public function create(object $objectClass, array $param): mixed
    {
        try {
            // Formatage des paramètres pour la requête SQL
            $valueString = self::formatParams($param, 'FORMAT_CREATE');

            // Construction de la requête SQL
            $sql = 'INSERT INTO ' . $this->_tableName . '(' . implode(', ', $param) . ') VALUES(' . $valueString . ')';
            // Désectivation ATTR_EMULATE_PREPARES
            $connect = $this->_dbConnect;

            // Début de la transaction
            $connect->beginTransaction();

            // Désactivation de l'émulation des préparations
            $connect->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            // Préparation de la requête SQL
            $req = $connect->prepare($sql);
            // Tableau pour les paramètres liés
            $boundParam = [];

            // Debug::view($sql);

            // Liaison des paramètres de l'objet avec les valeurs
            foreach ($param as $paramName) {
                if (property_exists($objectClass, $paramName)) {
                    $boundParam[$paramName] = $objectClass->$paramName;
                } else {
                    // Affichage d'une erreur si une propriété est manquante dans l'objet
                    echo "Une erreur est survenu lors de la création, veuillez verifier $paramName : $this->_objectClass";
                }
            }
            // Exécution de la requête avec les paramètres liés
            $req->execute($boundParam);

            // Récupération de l'ID du dernier enregistrement inséré
            $lastID = $connect->lastInsertId();

            // Validation de la transaction
            $connect->commit();

            // Retourne un tableau contenant l'objet créé et son ID
            return ['lastObject' => $objectClass, 'lastID' => $lastID];
        } catch (\PDOException $e) {
            // En cas d'erreur, annulation de la transaction et retourne un message d'erreur
            $connect->rollback();
            return 'PDOException : ' . $e->getMessage();
        }
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

    /************************************** Private Méthode */
    private function initFetchObject(string $tableName, mixed $objectModelData)
    {
        $this->_tableName = $tableName;
        $this->_objectClass = $objectModelData;
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
        /*
        $adresse = $this->_dbConnect->prepare('SELECT adress FROM users WHERE id = :client_id');
        $adresse->execute(['client_id' => $clientId]);
        $adresse->setFetchMode(\PDO::FETCH_ASSOC);
        $adresse = $adresse->fetch();
*/

        $sql = 'SELECT u.adress, o.*, p.* FROM orders o 
        JOIN productsorders po ON o.id = po.orders_id
        JOIN products p ON p.id = po.products_id
        join users u ON u.id = o.users_id 
        WHERE o.users_id = :client_id AND o.basket != 1';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute(['client_id' => $clientId]);
        $stmt->setFetchMode(\PDO::FETCH_OBJ);

        /*
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
*/
        return $stmt->fetchAll();
    }

    public function getbyidbasket($clientId)
    {
        $sql = 'SELECT p.id , i.url_image , p.name , p.price , o.* ,i.id FROM orders o 
                JOIN productsorders po ON o.id = po.orders_id 
                JOIN products p ON p.id = po.products_id 
                JOIN productsimages pi ON p.id = pi.products_id
                JOIN images i ON i.id = pi.images_id
                WHERE o.users_id = :client_id AND o.basket = 1';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':client_id' => $clientId]);
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function CreateOrder($clientId, $productId)
    {
        $sql = 'INSERT INTO orders (basket, status, created_at, updated_at, users_id) VALUES (1, "expedier", NOW(), NOW(), :client_id)';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':client_id' => $clientId]);

        $orderId = $this->_dbConnect->lastInsertId();

        $sql = 'INSERT INTO productsorders (products_id, orders_id) VALUES (:product_id, :order_id)';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':product_id' => $productId, ':order_id' => $orderId]);
    }

    public function RemoveFromCart($clientId, $productId)
    {
        // First, get the IDs of the orders to delete
        $sql = 'SELECT o.id FROM orders o
                JOIN productsorders po ON o.id = po.orders_id 
                WHERE o.users_id = :client_id AND po.products_id = :product_id AND o.basket = 1';
        $stmt = $this->_dbConnect->prepare($sql);
        $stmt->execute([':client_id' => $clientId, ':product_id' => $productId]);
        $orderIds = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        if (!empty($orderIds)) {
            // Delete the corresponding rows from the productsorders table
            $sql = 'DELETE FROM productsorders WHERE orders_id IN (' . implode(',', $orderIds) . ')';
            $stmt = $this->_dbConnect->prepare($sql);
            $stmt->execute();

            // Then, delete the orders
            $sql = 'DELETE FROM orders WHERE id IN (' . implode(',', $orderIds) . ')';
            $stmt = $this->_dbConnect->prepare($sql);
            $stmt->execute();
        }
    }

    /** NOTE - Voir si besoin d'enlever cette méthode
     * Methode de récupération du panier sous forme d'objet pour Stripe Checkout
     *
     * @param string $clientId [id de la requête]
     *
     *
     * @return array
     */
    public function GetBasketForStripe($clientId): array
    {
        $req = $this->_dbConnect->prepare(
            'SELECT o.*, p.id, p.name, p.price, i.id, i.url_image FROM orders o 
            INNER JOIN productsorders po ON o.id = po.orders_id
            INNER JOIN products p ON po.products_id = p.id 
            INNER JOIN productsimages pi ON p.id = pi.products_id
            INNER JOIN images i ON i.id = pi.images_id
            WHERE o.users_id = :client_id AND o.basket = 1',
        );
        $req->execute(['client_id' => $clientId]);
        $req->setFetchMode(\PDO::FETCH_OBJ);

        return $req->fetchAll();
    }

    /** NOTE - Méthode à modifier pour le footer
     * Methode de récupération des 3 produits les plus vendu
     *
     * @return object|array
     */
    public function TestGetBestThreeProducts(): object|array
    {
        $req = $this->_dbConnect->prepare(
            'SELECT o.id, o.status, p.id as productId, p.name as productName FROM ' .
                $this->_tableName .
                ' o INNER JOIN productsorders po ON o.id = po.orders_id INNER JOIN products p ON po.products_id = p.id WHERE o.status = 3 LIMIT 3',
        );
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);

        return $req->fetchAll();
    }

    /** NOTE - Méthode à modifier pour le footer
     * Methode de récupération des 3 sous catégories
     *
     * @return object|array
     */
    public function TestGetThreeCategory(): object|array
    {
        $req = $this->_dbConnect->prepare('SELECT * FROM ' . $this->_tableName . ' WHERE id IN (1, 4, 5)');
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $this->_objectClass);
        var_dump($req->fetchAll());
        return $req->fetchAll();
    }

    /**
     * Get the value of model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set the value of model
     *
     * @return  self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /************************************************* Méthode additionnel */
    /**
     * Method getColumnParam
     *
     * Avec cette méthode on récupérer les paramétre des colonnes de la base de données.
     * exemple : array(12) { ["Field"]=> string(6) "status" [0]=> string(6) "status" ["Type"]=> string(46) "enum('en attente','expedier','livrer','echec')" [1]=> string(46) "enum('en attente','expedier','livrer','echec')" ["Null"]=> string(3) "YES" [2]=> string(3) "YES" ["Key"]=> string(0) "" [3]=> string(0) "" ["Default"]=> NULL [4]=> NULL ["Extra"]=> string(0) "" [5]=> string(0) "" }
     * -> ["Type"]=> string(46) "enum('en attente','expedier','livrer','echec')
     *
     * @param string $column [nom de la collonne à récuperer]
     * @return bool|array
     */
    public function getColumnParam(string $column): bool|array
    {
        $sql = "SHOW COLUMNS 
              FROM {$this->_tableName} WHERE field = :column";

        // Désectivation ATTR_EMULATE_PREPARES
        $connect = $this->_dbConnect;

        // Prépare
        $req = $connect->prepare($sql);

        // Exécute
        $req->execute(['column' => $column]);
        return $req->fetch();
    }
}
