<?php

namespace App\Boutique\Components;

use Motor\Mvc\Builder\ModalBuilder;
/*
        'data-js' => 'handleViewHtml,click',
        'data-route' => '/api-html/template/basket',
        'data-target-id' => 'cart-items',
*/

class BasketModal
{

  public static function render()
  {

    $basketModal = new ModalBuilder();
    $basketModal->setSizeModal('max-w-7xl')
      ->setIdModal('modal-basket')
      ->addHeader(
        'head-modal-basket',
        '<span class="sr-only">Fenêtre avec vos derniers produit listé</span><span class="text-lg md:text-xl lg:text-2xl">Vos Achats</span>'
      )
      ->addBody(
        'body-modal-basket',
        '<article class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
           
              <div class="cart-items flex flex-wrap justify-center items-stretch gap-2">

              </div>
        
      </article>
        '
      )->addFooter(
        'footer-modal-basket',
        '<div id="bottom-cart-barre" tabindex="-1" class="fixed bottom-0 start-0 z-50 justify-between w-full lg:max-w-7xl lg:p-4 border-t border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
              <div class="flex items-center mx-auto">
                  <div class="flex  max-h-14 items-center justify-around text-sm font-normal text-gray-500 dark:text-gray-400 w-full">
                      
                        <span class="flex items-center justify-center me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                          <svg class="w-2.5 h-2.5" aria-hidden="true" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="none" fill-rule="evenodd"> <path d="m0 0h32v32h-32z"></path> <path d="m19 1.73205081 7.8564065 4.53589838c1.8564064 1.07179677 3 3.05255889 3 5.19615241v9.0717968c0 2.1435935-1.1435936 4.1243556-3 5.1961524l-7.8564065 4.5358984c-1.8564065 1.0717968-4.1435935 1.0717968-6 0l-7.85640646-4.5358984c-1.85640646-1.0717968-3-3.0525589-3-5.1961524v-9.0717968c0-2.14359352 1.14359354-4.12435564 3-5.19615241l7.85640646-4.53589838c1.8564065-1.07179677 4.1435935-1.07179677 6 0zm-4.791172 1.6195783-.208828.11247251-7.85640646 4.53589838c-1.17246724.67692428-1.91843145 1.89771701-1.99370617 3.2394348l-.00629383.2246668v9.0717968c0 1.3538485.68425541 2.6102689 1.80857977 3.3463176l.19142023.117784 7.85640646 4.5358984c1.1688485.674835 2.5938608.7123258 3.791172.1124725l.208828-.1124725 7.8564065-4.5358984c1.1724672-.6769243 1.9184314-1.897717 1.9937061-3.2394348l.0062939-.2246668v-9.0717968c0-1.3538485-.6842555-2.61026887-1.8085798-3.34631759l-.1914202-.11778401-7.8564065-4.53589838c-1.1688485-.67483501-2.5938608-.71232584-3.791172-.11247251zm8.8114886 8.20574889c.259282.4876385.0741624 1.0931371-.4134761 1.3524191l-5.6183556 2.9868539.0000413 6.7689186c0 .5522848-.4477152 1-1 1-.5522847 0-1-.4477152-1-1l-.0000413-6.7689186-5.61827304-2.9868539c-.48763849-.259282-.67275801-.8647806-.41347603-1.3524191.25928199-.4876385.86478067-.672758 1.35241917-.4134761l5.6793299 3.0187491 5.6794125-3.0187491c.4876385-.2592819 1.0931372-.0741624 1.3524192.4134761z" fill="#000000" fill-rule="nonzero"></path> </g> </g></svg>
                          <span class="sr-only">Icon représentatif du nombres de produits de la commande</span>
                          <span id="cart-details-products" class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">0</span>
                        </span>

                        <span class="flex items-center justify-center  me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                          <svg class="w-2.5 h-2.5" aria-hidden="true" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M5 21C5 17.134 8.13401 14 12 14C15.866 14 19 17.134 19 21M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                          <span class="sr-only">Icon User</span>
                          <span id="cart-details-users" class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300"><a href="/connexion" title="Ce connecté(e) pour valider la commande">Non connecté(e)</a></span>
                        </span>

                        <span class="flex items-center justify-center  me-2 text-sm font-semibold text-gray-800 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-300">
                          <svg class="w-2.5 h-2.5" aria-hidden="true" viewBox="0 0 14 14" role="img" focusable="false" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#3a6506" d="M7.31578947 1.00000007L1.37894743 6.93684211c-.50526315.50526315-.50526315 1.29473682 0 1.79999998l3.88421048 3.88421048c.50526316.50526315 1.29473683.50526315 1.79999998 0l5.93684204-5.93684204V2.26315795c0-.69473683-.56842105-1.26315788-1.26315788-1.26315788H7.31578947zm3.78947364 2.52631576c-.34736842 0-.63157894-.28421052-.63157894-.63157894s.28421052-.63157894.63157894-.63157894.63157894.28421052.63157894.63157894-.28421052.63157894-.63157894.63157894z"></path><path fill="#ecd613" d="M8.32631577 6.77894737l-.37894736.37894737-.85263157-.85263157-.31578947.31578947.85263157.85263157-.37894736.37894736L6.43157895 7c-.15789473.18947368-.75789472.72631578.03157895 1.51578946.22105263.22105263.44210526.34736841.56842105.4105263l-.50526315.69473684C6.4 9.5578947 5.9894737 9.24210524 5.8 9.05263156c-.56842104-.56842105-1.16842103-1.73684209-.09473684-2.77894734l-.4105263-.41052631.37894736-.37894737.4105263.41052632L6.4 5.57894739l-.41052631-.41052632.37894736-.37894736.44210526.44210526c.28421052-.28421052 1.4842105-1.16842104 2.81052628.15789473.22105263.22105263.44210526.5368421.50526315.66315789l-.69473683.50526315c-.03157895-.09473684-.15789474-.31578947-.37894737-.5368421-.72631578-.72631578-1.35789472-.15789473-1.51578945-.0631579l.78947367.82105263z"></path></g></svg>
                          <span class="sr-only">Icon Prix €</span>
                          <span id="cart-details-prices" class="text-gray-500 dark:text-gray-400 text:base lg:text-xl">0 €</span>
                        </span>

                   
                  </div>
              </div>
          </div>'
      );

    $buttonModal = $basketModal->renderOpenButton(
      '&nbsp;',
      [
        'type' => 'button',
        'class' =>
        'bg-basket-light dark:bg-basket-dark bg-center bg-no-repeat rounded-full h-6 w-6 md:h-8 md:w-8 lg:h-9 lg:w-9 2xl:h-10 2xl:w-10 mx-2',

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
