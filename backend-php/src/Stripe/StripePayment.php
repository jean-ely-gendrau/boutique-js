<?php

namespace App\Boutique\Stripe;

use Motor\Mvc\Components\DockerSecrets;
use Motor\Mvc\Enum\SecretsEnum;
use Stripe\Checkout\Session;

class StripePayment
{
    public function __construct()
    {
    }

    public function StartPayment($basket)
    {
        // TODO Voir où enregistrer la clé d'API
        $stripeSecretKey = DockerSecrets::getSecrets(SecretsEnum::Api_Key_Stripe);

        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $YOUR_DOMAIN = 'http://boutique-js.test:8880/';

        // Initialiser un tableau pour suivre le nombre d'occurrences de chaque produit
        $line_items = [];

        foreach ($basket as $product) {
            $found = false;
            // Passage de la variable $item en reference avec l'opérateur &
            foreach ($line_items as &$item) {
                // Si une valeur du tableau $line_items correspond alors on modifie la valeur quantity de + 1
                if ($item['price_data']['product_data']['name'] === $product->name) {
                    $item['quantity'] += 1;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                // Si aucune correspondance alors on ajoute la valeur directement
                $line_items[] = [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'EUR',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => $product->price * 100,
                    ],
                ];
            }
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
        // Voir implementation d'image de produits par Content Delivery Network

        // Voir nécéssité des header
        header('HTTP/1.1 303 See Other');
        header('Location: ' . $session->url);
    }
}
