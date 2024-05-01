<?php

namespace App\Boutique\Controllers;

use App\Boutique\Models\ProductsModels;
use Motor\Mvc\Manager\CrudManager;
use App\Boutique\Controllers\StripePayment;

class Stripe
{
    public function __construct()
    {
    }

    public function Index(...$arguments)
    {
        $crudManager = new CrudManager('products', ProductsModels::class);
        $productSelected = $crudManager->getOneProduct(22);
        $arguments['render']->addParams('product', $productSelected);
        $content = $arguments['render']->render('basket', $arguments);
        return $content;
    }

    public function Pay(...$arguments)
    {
        $crudManager = new CrudManager('products', ProductsModels::class);
        $product = $crudManager->getOneProduct(22);
        $payment = new StripePayment();
        $payment->StartPayment($product);
        // render
        // $arguments['render']->addParams('checkout_session', $checkout_session->url);
        //         $content = $arguments['render']->render('/stripe/checkout', $arguments);
    }
}
//     require_once '../vendor/autoload.php';
//     // Variable dans .env ?
//     // require_once '../.env';
//     $crudManager = new CrudManager('products', ProductsModels::class);
//     $product = $crudManager->getOneProduct(22);
//     $stripeSecretKey = '';
//     \Stripe\Stripe::setApiKey($stripeSecretKey);
//     header('Content-Type: application/json');

//     $YOUR_DOMAIN = 'http://boutique-js.test/';
//     try {
//         $checkout_session = \Stripe\Checkout\Session::create([
//             'line_items' => [
//                 [
//                     # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
//                     'quantity' => 1,
//                     'price_data' => [
//                         'currency' => 'EUR',
//                         'product_data' => [
//                             'name' => "$product->name",
//                         ],
//                         'unit_amount' => "$product->price",
//                     ],
//                 ],
//             ],
//             'mode' => 'payment',
//             'success_url' => $YOUR_DOMAIN . '/stripe/success',
//             'cancel_url' => $YOUR_DOMAIN . '/stripe/cancel',
//         ]);
//         header('HTTP/1.1 303 See Other');

//         $arguments['render']->addParams('checkout_session', $checkout_session->url);
//         $content = $arguments['render']->render('/stripe/checkout', $arguments);
//         return $content;
//     } catch (\Exception $e) {
//         error_log('Error creating checkout session: ' . $e->getMessage());

//         return 'Une erreur est survenue lors du traitement de votre paiement. Veuillez réessayer plus tard.';
//     }

// header('Location: ' . $checkout_session->url);
