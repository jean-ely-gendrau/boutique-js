<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\HydrateOrderUserProduct;
use App\Boutique\Enum\BasketSvgEnum;
use App\Boutique\Enum\ClientExceptionEnum;
use App\Boutique\Exceptions\ClientExceptions;
use App\Boutique\Forms\ButtonControlForms;
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

        // Si Nous n'avons aucun résultat dans la reqêtte précédante Throw
        if (empty($Idclient)) {
            throw new ClientExceptions(ClientExceptionEnum::NotConnected); // EXCEPTION NotConnected
        }

        $order = new CrudManager('orders', 'Historique');
        $clientId = $Idclient?->id; // Get the client's id from the arguments


        $orders = $order->getOrderById($clientId, 0); // Get the orders by the client's id
        // var_dump($orders);

        // Tableau de params pour la méthode hydrate
        $argumentsToHydrate = [
            'dataToHydrates' => $orders,
            'productsModels' => new ProductsModels(),
            'usersModels' => new Users(),
            'ordersModels' => new Orders()
        ];
        //Hydratée les models utlisée dans la vue avec les données client.
        $hydrateOrderUserProduct = HydrateOrderUserProduct::hydrate($argumentsToHydrate);


        // Now $orders should contain all orders made by the client

        /* FEEDBACK MODAL */
        $modalFeedback = new ModalBuilder();
        $modalFeedback->setIdModal('modal-form-feedback');
        $modalFeedback->addHeader('modal-add-feedback', '<h2 class="text-gray-900 text-base md:text-lg text-center block w-full p-2.5 dark:text-white">Noter le produit</h2>')
            ->addBody('body-modal-add-feedback', '<div id="feedback-form"></div>');

        /*
        echo '<pre>', var_dump(
            'userModel',
            $userModel,
            'productModel',
            $productsModels,
            'orderModel',
            $ordersModels
        ), '</pre>';
        */

        /* FEEDBACK MODAL */
        $render->addParams([
            'basketStatus' => BasketSvgEnum::class,
            'buttonControlForms' => ButtonControlForms::class,
            'modalFeedback' => $modalFeedback,
            'userModel' => $hydrateOrderUserProduct->userModel,
            'productModel' => $hydrateOrderUserProduct->productsModels,
            'orderModel' => $hydrateOrderUserProduct->ordersModels
        ]);


        return  $render->render('historique', $arguments);
    }
}
