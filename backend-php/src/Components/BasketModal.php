<?php

namespace App\Boutique\Components;

use Motor\Mvc\Builder\ModalBuilder;

class BasketModal
{

  public static function render()
  {

    $basketModal = new ModalBuilder();
    $basketModal->setIdModal('modal-basket');
    $basketModal->addBody(
      'body-modal-basket',
      '<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
              <div class="cart-items">

              </div>
            </tbody>
      </table>
        '
    );
    $basketModal->addFooter('footer-modal-basket', '');

    $buttonModal = $basketModal->renderOpenButton(
      '&nbsp;',
      [
        'type' => 'button',
        'class' =>
        'bg-basket-light dark:bg-basket-dark bg-center bg-no-repeat rounded-full h-6 w-6 md:h-8 md:w-8 lg:h-9 lg:w-9 2xl:h-10 2xl:w-10 mx-2',
        'data-js' => 'handleViewHtml,click',
        'data-route' => '/api-html/template/basket',
        'data-target-id' => 'cart-items',
      ]
    );

    return (object)['modal' => $basketModal->render(), 'buttonModal' => $buttonModal];
  }

  public static function itemsToCartHtml(...$arguments)
  {
    var_dump($arguments);
    return
      <<<HTML
    <div class="cart-items">

    </div>
    HTML;
  }
}
