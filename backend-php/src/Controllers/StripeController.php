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
use Motor\Mvc\Builder\ModalBuilder;

class StripeController
{
    public function __construct()
    {
    }

    public function Pay(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $rendering */
        $rendering = $arguments['render'];

        if (!isset($_SESSION['email'])) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            $content = $rendering->render('connexion', $arguments);
            return $content;
        }
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
        /** @var \Motor\Mvc\Utils\Render $rendering */
        $rendering = $arguments['render'];

        if (isset($_SESSION['isConnected'])) {
            //       if (isset($_COOKIE['stripe'])) {
            try {
                unset($_COOKIE['stripe']);
                setcookie('stripe', '', -1, '/');

                $IdclientCrudManager = new CrudManager('users', Users::class);
                $Idclient = $IdclientCrudManager->getByEmail($_SESSION['email']);

                $crudManagerOrder = new CrudManager('orders', Orders::class);
                $commandes = $crudManagerOrder->GetBasketForStripe($Idclient->id);
                foreach ($commandes as $commande) {
                    $ordermodel = new Orders((array)$commande);
                    $ordermodel->setBasket(0);
                    $crudManagerOrder->update($ordermodel, ['id', 'basket']);
                }

                $rendering->addParams('commande', $commandes);

                /* FEEDBACK MODAL */
                $modalFeedback = new ModalBuilder();
                $modalFeedback->setIdModal('modal-form-feedback');
                $modalFeedback->addHeader('modal-add-feedback', '<h2 class="text-gray-900 text-base md:text-lg text-center block w-full p-2.5 dark:text-white">Noter le produit</h2>')
                    ->addBody('body-modal-add-feedback', '<div id="feedback-form"></div>');

                $rendering->addParams([
                    'modalFeedback' => $modalFeedback,
                ]);
                /* FEEDBACK MODAL */

                $content = $rendering->render('stripe/success', $arguments);
                return $content;
            } catch (Exception $e) {
                $content = $rendering->render('404', $arguments);
                return $content;
            }
            //     } else {
            //          $content = $rendering->render('404', $arguments);
            //          return $content;
            //      }
        } else {
            $content = $rendering->render('404', $arguments);
            return $content;
        }
    }

    public function Cancel(...$arguments)
    {
        /** @var \Motor\Mvc\Utils\Render $rendering */
        $rendering = $arguments['render'];

        if (isset($_SESSION['isConnected'])) {
            if (isset($_COOKIE['stripe'])) {
                try {
                    $crudManagerUsers = new CrudManager('users', Users::class);
                    $Idclient = $crudManagerUsers->getByEmail($_SESSION['email']);

                    $rendering->addParams('client', $Idclient);

                    $crudManagerProducts = new CrudManager('products', ProductsModels::class);
                    $slider = new Slider();
                    $products = $crudManagerProducts->getAllProduct();
                    $allProducts = $slider->generateProductList($products, 'id-scroll-x-1');

                    $rendering->addParams('products', $allProducts);

                    $content = $rendering->render('stripe/cancel', $arguments);

                    unset($_COOKIE['stripe']);
                    setcookie('stripe', '', -1, '/');

                    return $content;
                } catch (Exception $e) {
                    $content = $rendering->render('404', $arguments);
                    return $content;
                }
            } else {
                $content = $rendering->render('404', $arguments);
                return $content;
            }
        } else {
            $content = $rendering->render('404', $arguments);
            return $content;
        }
    }
}
