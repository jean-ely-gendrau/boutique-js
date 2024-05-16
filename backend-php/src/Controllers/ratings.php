<?php
namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\BddManager;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;


class Ratings extends CrudManager
{
    public function __construct()
    {
        parent::__construct('users', ProductsModels::class);
    }

    public function ProductOrdered(...$arguments)
    {
        if (isset($_SESSION['isConnected'])) {
            $IdclientCrudManager = new CrudManager('users', ProductsModels::class);
            $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
            $id = $Idclient->id;
            $idProduct = $arguments['idProduct'];
            $sql = "SELECT 1 AS ordered
        FROM orders o
        JOIN productsorders po ON o.id = po.orders_id
        WHERE o.users_id = $id AND po.products_id = $idProduct;";
            $query = $this->getConnectBdd()->prepare($sql);
            $result = $query->execute();
            var_dump($query);
            var_dump($result);
            echo json_encode($result);
        }

    }

    public function ProductRating(...$arguments)
    {
        $idProduct = $arguments['idProduct'];
        $sql = "SELECT AVG(rating) AS average_rating 
        FROM ratings 
        WHERE products_id = $idProduct;";
        $query = $this->getConnectBdd()->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($result[0]["average_rating"]);
    }
}