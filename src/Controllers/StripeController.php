<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\Orders;
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

        $crudManagerOrder = new CrudManager('orders', Orders::class);
        $panier = $crudManagerOrder->IdBasket($Idclient->id);

        $arguments['render']->addParams('panier', $panier);

        $content = $arguments['render']->render('basket', $arguments);
        return $content;
    }

    public function Pay(...$arguments)
    {
        /**NOTE - Voir récupération des données du panier, ne pas créer de doublon de requête */
        $IdclientCrudManager = new CrudManager('users', Users::class);
        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);

        $crudManagerOrder = new CrudManager('orders', Orders::class);
        $panier = $crudManagerOrder->IdBasket($Idclient->id);

        $payment = new StripePayment();
        $payment->StartPayment($panier);
    }
}
