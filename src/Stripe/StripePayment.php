<?php

namespace App\Boutique\Stripe;
use Stripe\Checkout\Session;

class StripePayment
{
    public function __construct()
    {
    }

    public function StartPayment($panier)
    {
        // TODO Voir où enregistrer la clé d'API
        require_once '../config/config.php';

        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $YOUR_DOMAIN = 'http://boutique-js.test/';

        // Ici voir quel id pour la commande à utiliser [pour le test j'utilise l'id product]
        // $panierId = $panier->id;

        $line_items = [];

        foreach ($panier as $produit) {
            $line_items[] = [
                'quantity' => 1, // Vous pouvez modifier la quantité si nécessaire
                'price_data' => [
                    'currency' => 'EUR',
                    'product_data' => [
                        'name' => $produit->name,
                    ],
                    'unit_amount' => $produit->price * 100, // Assurez-vous que le prix est en centimes
                ],
            ];
        }

        $session = Session::create([
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'stripe/success',
            'cancel_url' => $YOUR_DOMAIN . 'stripe/cancel',
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR'],
            ],
        ]);
        // Voir implementation d'une methode d'initialisation de de $session
        // $cart->setSessionId($session->id);

        // Voir nécéssité des header
        header('HTTP/1.1 303 See Other');
        header('Location: ' . $session->url);
    }
}
