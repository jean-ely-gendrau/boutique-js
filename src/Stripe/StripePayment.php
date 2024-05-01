<?php

namespace App\Boutique\Stripe;
use Stripe\Checkout\Session;

class StripePayment
{
    public function __construct()
    {
    }

    public function StartPayment($cart)
    {
        // TODO Voir où enregistrer la clé d'API
        require_once '../config/config.php';

        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $YOUR_DOMAIN = 'http://boutique-js.test/';

        // Ici voir quel id pour la commande à utiliser [pour le test j'utilise l'id product]
        $cartId = $cart->id;

        $session = Session::create([
            'line_items' => [
                [
                    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => "$cart->name",
                        ],
                        'unit_amount' => "$cart->price", // A voir absolument, modification du type pour price dans la bdd
                    ],
                ],
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'stripe/success',
            'cancel_url' => $YOUR_DOMAIN . 'stripe/cancel',
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR'],
            ],
            'metadata' => [
                'cart_id' => $cartId,
            ],
        ]);
        // Voir implementation d'une methode d'initialisation de de $session
        // $cart->setSessionId($session->id);

        // Voir nécéssité des header
        header('HTTP/1.1 303 See Other');
        header('Location: ' . $session->url);
    }
}
