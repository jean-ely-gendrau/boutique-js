<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\Orders;
use App\Boutique\Models\ProductsModels;
use Motor\Mvc\Manager\CrudManager;

use App\Boutique\Models\Users;
use Motor\Mvc\Builder\ModalBuilder;

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
        $orders = $order->getOrderById($clientId, 0); // Get the orders by the client's id

        $usersModel = new Users();
        $usersModel = new ProductsModels();
        $usersModel = new Orders();
        // Now $orders should contain all orders made by the client

        /* FEEDBACK MODAL */
        $modalFeedback = new ModalBuilder();
        $modalFeedback->setIdModal('modal-form-feedback');
        $modalFeedback->addHeader('modal-add-feedback', '<h2 class="text-gray-900 text-base md:text-lg text-center block w-full p-2.5 dark:text-white">Noter le produit</h2>')
            ->addBody('body-modal-add-feedback', '<div id="feedback-form"></div>');


        /* FEEDBACK MODAL */
        $render->addParams([
            'modalFeedback' => $modalFeedback,
            'orders' => $orders
        ]);


        return  $render->render('historique', $arguments);
    }
}
