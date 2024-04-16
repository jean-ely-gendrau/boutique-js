<?php


namespace App\Boutique\Controllers;

use App\Boutique\Manager\CrudManager;



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
        $order = new CrudManager("orders", "Historique");
        $clientId = $arguments[0]; // Get the client's id from the arguments
        $orders = $order->getbyid($clientId); // Get the orders by the client's id

        // Now $orders should contain all orders made by the client
    }
}
