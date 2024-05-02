<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\ProductsModels;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Stripe\StripePayment;

class StripeController
{
    public function __construct()
    {
    }

    public function Index(...$arguments)
    {
        // Requête du produit d'id 22, Order n'étant pas fonctionnel pour le moment
        $crudManager = new CrudManager('products', ProductsModels::class);
        $productSelected = $crudManager->getOneProduct(1);
        $arguments['render']->addParams('product', $productSelected);

        // Affichage d'un panier basket, à supprimé quand la bdd de nouveau opérationnelle
        $content = $arguments['render']->render('basket', $arguments);
        return $content;
    }

    public function Pay(...$arguments)
    {
        // Requête du même produit pour simuler une validation de panier
        $crudManager = new CrudManager('products', ProductsModels::class);
        $product = $crudManager->getOneProduct(1);

        /* Instance de StripePayment, permet de renvoyer la page Stripe checkout avec les données du produit en paramètre */
        $payment = new StripePayment();
        $payment->StartPayment($product);
    }
}
