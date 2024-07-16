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
      '<svg viewBox="0 0 50 50" class="rounded-full fill-gray-700 stroke-white dark:fill-white dark:stroke-gray-900 h-6 w-6 md:h-7 md:w-7 lg:h-8 lg:w-8 2xl:h-10 2xl:w-10" xmlns="https://www.w3.org/2000/svg">
        <path d="M35 34H13c-.3 0-.6-.2-.8-.4s-.2-.6-.1-.9l1.9-4.8L12.1 10H6V8h7c.5 0 .9.4 1 .9l2 19c0 .2 0 .3-.1.5L14.5 32H36l-1 2z" />
        <path d="M15.2 29l-.4-2L38 22.2V14H14v-2h25c.6 0 1 .4 1 1v10c0 .5-.3.9-.8 1l-24 5z" />
        <path d="M36 40c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
        <path d="M12 40c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
      </svg>',
      [
        'type' => 'button',
        'class' =>
        'rounded-full fill-gray-700 stroke-white dark:fill-white dark:stroke-gray-900 h-6 w-6 md:h-7 md:w-7 lg:h-8 lg:w-8 2xl:h-9 2xl:w-9 mx-2',
        'data-js' => 'handleViewHtml,click',
        'data-route' => "/api-html/template/modalBasket",
        'data-target-id' => 'cart-items',
      ]
    );

    return (object)['modal' => $basketModal->render(), 'buttonModal' => $buttonModal];
  }

  public static function itemsToCartHtml(...$arguments)
  {
    return
      <<<HTML
    <div class="cart-items">

    </div>
    HTML;
  }
}
