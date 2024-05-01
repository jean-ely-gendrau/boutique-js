<?php

namespace App\Boutique\Controllers;
use Stripe\Checkout\Session;

class StripePayment
{
    public function __construct()
    {
    }

    public function StartPayment($cart)
    {
        require_once '../config/config.php';

        \Stripe\Stripe::setApiKey($stripeSecretKey);

        $YOUR_DOMAIN = 'http://boutique-js.test/';

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
                        'unit_amount' => "$cart->price",
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
        // $cart->setSessionId($session->id);

        header('HTTP/1.1 303 See Other');
        header('Location: ' . $session->url);
    }
}
