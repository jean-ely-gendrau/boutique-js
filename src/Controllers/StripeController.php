<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\Orders;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Stripe\StripePayment;

class StripeController
{
    public function __construct()
    {
    }

    public function Index(...$arguments)
    {
        $IdclientCrudManager = new CrudManager('users', Users::class);

        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        // var_dump($Idclient);
        /*FIXME - Bricolage en attendant refonte Class Users*/
        // $id_user = 206;

        $crudManagerOrder = new CrudManager('orders', Orders::class);
        $panier = $crudManagerOrder->IdBasket($Idclient->id); // Get the orders by the client's id
        // var_dump($panier);

        $arguments['render']->addParams('panier', $panier);
        // Return both the client's ID and the orders
        $content = $arguments['render']->render('basket', $arguments);
        return $content;
    }

    public function Pay(...$arguments)
    {
        // // Requête du même produit pour simuler une validation de panier
        // $crudManager = new CrudManager('products', ProductsModels::class);
        // $product = $crudManager->getOneProduct(1);

        /**NOTE - Voir récupération des données du panier, ne pas créer de doublon de requête */
        $IdclientCrudManager = new CrudManager('users', Users::class);
        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);
        $crudManagerOrder = new CrudManager('orders', Orders::class);
        $panier = $crudManagerOrder->IdBasket($Idclient->id);

        // $orders = $arguments['render']->getParams('panier');
        // /* Instance de StripePayment, permet de renvoyer la page Stripe checkout avec les données du produit en paramètre */
        $payment = new StripePayment();
        $payment->StartPayment($panier);
        // $payment->TestGetArgument($orders);
    }
}
