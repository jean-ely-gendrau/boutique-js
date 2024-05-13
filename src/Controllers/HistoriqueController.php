<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\Users;

class HistoriqueController
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

    public function Historique(...$arguments)
    {

        if (!isset($_SESSION['email'])) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            header('Location: /inscription');
            exit();
        }

        /** @var \Motor\Mvc\Utils\Render */
        $render = $arguments['render'];

        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);


        $order = new CrudManager('orders', 'Historique');
        $clientId = $Idclient->id; // Get the client's id from the arguments
        $orders = $order->getByIdOrder($clientId); // Get the orders by the client's id

        // Now $orders should contain all orders made by the client

        $render->addParams('orders', $orders);
        return  $render->render('historique', $arguments);
    }
}
