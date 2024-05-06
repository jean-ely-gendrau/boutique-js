<?php
namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;

class Favoris extends CrudManager
{
    public function __construct()
    {
        parent::__construct('users', ProductsModels::class);
    }

    public function VerifyFavorite(...$arguments)
    {
        if (isset($_SESSION['isConnected'])) {
            $user = $this->getByEmail($_SESSION['email']);
            $sql = "SELECT * FROM users JOIN user_product ON users.id = user_product.user_id JOIN products ON user_product.product_id = products.id WHERE users.id = [user_id] AND products.id = [product_id]";
            echo json_encode([$user->id, intval($arguments['product'])]);
        } else {
            echo json_encode("connect to use");
        }
    }
}