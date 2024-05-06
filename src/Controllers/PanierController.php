<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\Users;
use App\Boutique\Models\Orders;
use DateTime;

class PanierController
{
    public function __construct()
    {
        /* Action du constucteur */
    }

    /**
     * Méthode Index qui affiche les variables transmises à la méthode.
     *
     * @param array ...$arguments
     * @return void
     */
    public function Index(...$arguments)
    {
        /*
         * Utilisation de la méthode Index dans notre exemple avec l'affichage des variables transmises à la méthode
         */
        return var_dump($arguments);
    }

    /**
     * Fonction View qui récupère les données de la classe Exemple, les ajoute aux paramètres,
     * renvoie une vue template nommée 'test-render', et retourne le contenu.
     *
     * @param array ...$arguments
     * @return string
     */
    public function View(...$arguments)
    {
    }

    public function Panier(...$arguments)
    {
        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        $id = $Idclient->id;

        $panier = new CrudManager('orders', Orders::class);
        $paniers = $panier->getbyidbasket($id); // Get the orders by the client's id

        // Return both the client's ID and the orders



        $result = [
            'name' => $paniers['name'],
            'price' => $paniers['price'],
            'images' => $paniers['url_image'],

        ];


        return $result;
    }

    public function AddToBasket(...$arguments)
    {
        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        $id = $Idclient->id_user;

        $idproduct = $arguments["product_id"] ?? null;


        $now = new DateTime();
        $formattedNow = $now->format('Y-m-d H:i:s');


        $order = [
            'basket' => TRUE,
            'status' => "expedier",
            'created_at' => $formattedNow,
            'updated_at' => $formattedNow,
            'users_id' => $id,
        ];

        $panier = new ApiController();

        $panier->addOrders($order);

        var_dump($order);

        return;
    }
}
