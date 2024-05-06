<?php
namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Models\ProductsModels;

class Favoris extends CrudManager
{
    public function __construct()
    {
        parent::__construct('products', ProductsModels::class);
    }

    // public function JsIsConnected(...$arguments)
    // {
    //     if (isset($_SESSION['isConnected'])) {
    //         echo json_encode($_SESSION['email']);
    //     } else {
    //         echo json_encode(False);
    //     }
    // }
    public function VerifyFavorite(...$arguments)
    {
        if (isset($_SESSION['isConnected'])) {
            var_dump($_SESSION['email']);
            var_dump($this->getByEmail($_SESSION['email']));
        }
    }
}