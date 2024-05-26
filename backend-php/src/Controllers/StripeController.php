<?php

namespace App\Boutique\Controllers;

use App\Boutique\Components\Slider;
use App\Boutique\Models\Orders;
use App\Boutique\Models\ProductsModels;
use App\Boutique\Models\Users;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Stripe\StripePayment;
use Error;
use Exception;

class StripeController
{
    public function __construct()
    {
    }

    public function Pay(...$arguments)
    {
        /**NOTE - Voir récupération des données du panier, ne pas créer de doublon de requête */
        $IdclientCrudManager = new CrudManager('users', Users::class);
        $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);

        $crudManagerOrder = new CrudManager('orders', Orders::class);
        $panier = $crudManagerOrder->GetBasketForStripe($Idclient->id);

        $payment = new StripePayment();
        $payment->StartPayment($panier);
    }

    public function Success(...$arguments)
    {
        if (isset($_SESSION['isConnected'])) {
            if(isset($_COOKIE['stripe'])){
                try{
                    $IdclientCrudManager = new CrudManager('users', Users::class);
                    $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);

                    $crudManagerOrder = new CrudManager('orders', Orders::class);
                    $commande = $crudManagerOrder->GetBasketForStripe($Idclient->id);

                    $arguments['render']->addParams('commande', $commande);

                    $content = $arguments['render']->render('stripe/success', $arguments);

                    unset($_COOKIE['stripe']); 
                    setcookie('stripe', '', -1, '/'); 

                    return $content;
                } catch (Exception $e) {
                    $content = $arguments['render']->render('404', $arguments);
                    return $content;
                } 
            } else {
                $content = $arguments['render']->render('404', $arguments);
                return $content;
            }
        } else {
            $content = $arguments['render']->render('404', $arguments);
            return $content;
        }
        
    }

    public function Cancel(...$arguments)
    {
        if (isset($_SESSION['isConnected'])) {
            if(isset($_COOKIE['stripe'])){
                try{
                    $crudManagerUsers = new CrudManager('users', Users::class);
                    $Idclient = $crudManagerUsers->getByEmail($_SESSION['email']);

                    $arguments['render']->addParams('client', $Idclient);

                    $crudManagerProducts = new CrudManager('products', ProductsModels::class);
                    $slider = new Slider();
                    $products = $crudManagerProducts->getAllProduct();
                    $allProducts = $slider->generateProductList($products, 'id-scroll-x-1');

                    $arguments['render']->addParams('products', $allProducts);

                    $content = $arguments['render']->render('stripe/cancel', $arguments);

                    unset($_COOKIE['stripe']); 
                    setcookie('stripe', '', -1, '/'); 

                    return $content;
                } catch (Exception $e) {
                    $content = $arguments['render']->render('404', $arguments);
                    return $content;
                } 
            } else {
                $content = $arguments['render']->render('404', $arguments);
                return $content;
            }
        } else {
            $content = $arguments['render']->render('404', $arguments);
            return $content;
        }
    }
}
