<?php

namespace App\Boutique\Controllers;

use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\Users;

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
        $id = $Idclient->id_user;

        $panier = new CrudManager('orders', 'Panier');
        $paniers = $panier->getbyidbasket($id); // Get the orders by the client's id

        // Return both the client's ID and the orders
        return [
            'id' => $id,
            'paniers' => $paniers,
        ];
    }
}
