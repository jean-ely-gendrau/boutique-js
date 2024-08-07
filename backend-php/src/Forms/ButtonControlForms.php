<?php

namespace App\Boutique\Forms;

use Motor\Mvc\Builder\FormBuilder;
use Motor\Mvc\Validators\ValidatorJS;

class ButtonControlForms
{

  public static function buttonPaginationProduct($pagination, $arguments, $serverName)
  {
    //FormBuilder Button
    $buttonNavigation = new FormBuilder();

    $buttonNavigation->setClassForm('flex flex-col justify-center items-center md:flex-row md:flex-nowrap gap-5 my-5');
    $buttonNavigation->setClassActionGroup('flex flex-row flex-nowrap gap-5');
    $buttonNavigation->addElementAction('link', 'last_button', 'last_button', [
      'class' => "flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
      'label-false' => 1,
      'anchor' => 'Précédant',
      'attributes' => [
        'href' => $pagination['page_last'] ? "https://{$serverName}/produit/{$arguments['categoryName']}/{$pagination['page_last']}" : '#',
        'disabled' => $pagination['page_last'] ? '' : 'disabled',
      ]
    ]);

    $buttonNavigation->addField('number', 'select_pages', [
      'class-label-group' => 'relative flex flex-nowrap text-gray-900 dark:text-white items-center gap-2',
      'label-false' => 1,
      'indicator' => 'page',
      'class' => "flex items-center justify-center px-4 w-20 h-10 text-center text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
      'attributes' => [
        'value' => $arguments['page'] ?? 1,
        'data-js' => 'handleClick,change',
        'data-action' => 'redirectByValue',
        'data-link' => "https://{$serverName}/produit/{$arguments['categoryName']}/{{id}}",
        'data-min' => 1,
        'data-max' => $pagination['number_pages'],
        'data-tooltip-target' => 'tooltip-warn-select_pages'
      ],
      'error-tooltip' => "La valeur dois être comprise entre 1 et {$pagination['number_pages']}",
    ]);

    $buttonNavigation->addField('number', 'number_pages', [
      'class-label-group' => 'relative flex flex-nowrap text-gray-900 dark:text-white items-center gap-2',
      'label-false' => 1,
      'indicator' => 'total',
      'class' => "flex items-center justify-center px-4 w-20 h-10 text-center text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
      'attributes' => [
        'value' => $pagination['number_pages'],
        'disabled' => 'disabled',
      ]
    ]);

    $buttonNavigation->addElementAction('link', 'next_button', 'next_button', [
      'label-false' => 1,
      'class' => "flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
      'anchor' => 'Suivant',
      'attributes' => [
        'href' => $pagination['page_next'] ? "https://{$serverName}/produit/{$arguments['categoryName']}/{$pagination['page_next']}" : '#',
        'disabled' => $pagination['page_next'] ? '' : 'disabled',
      ]
    ]);

    return $buttonNavigation;
  }

  public static function buttonFilterProduct(array $getSubCategory)
  {

    $buttonFilterNavigation = new FormBuilder();
    $buttonFilterNavigation->setClassForm('flex flex-col md:flex-row items-center gap-5 m-auto my-5');

    $buttonFilterNavigation->addField('select', 'counterSubCat', [
      'label-false' => 1,
      'options-selected' => "0",
      'class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
      'options-select-array' => json_decode(json_encode($getSubCategory), true),
      'select-array-multi' => 1,
      'options-keys' => ['keyValue' => 'idSubCat', 'keyText' => 'nameSubCat']
    ]);
    $buttonFilterNavigation->setClassActionGroup('flex flex-col md:flex-row justify-center items-center gap-5 m-auto my-5');
    $buttonFilterNavigation->addElementAction('button', 'expensive', 'expensive', [
      'class' => 'filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800 ',
      'label-false' => 1,
      'attributes' => ['value' => 'expensive'],
      'anchor' => 'Plus cher'
    ])->addElementAction('button', 'cheaper', 'cheaper', [
      'class' => 'filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800',
      'label-false' => 1,
      'attributes' => ['value' => 'cheaper'],
      'anchor' => 'Moins cher'
    ])->addElementAction('button', 'bestSeller', 'bestSeller', [
      'class' => 'filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800',
      'label-false' => 1,
      'attributes' => ['value' => 'bestSeller'],
      'anchor' => 'Top des ventes'
    ])->addElementAction('button', 'bestRated', 'bestRated', [
      'class' => 'filters text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800',
      'label-false' => 1,
      'attributes' => ['value' => 'bestRated'],
      'anchor' => 'Top des ventes'
    ])->addElementAction('button', 'clear', 'clear', [
      'class' => 'text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900',
      'label-false' => 1,
      'attributes' => ['value' => 'clear'],
      'anchor' => 'Clear'
    ]);

    return $buttonFilterNavigation;
  }

  public static function buttonUpdateQuantityProduct($product)
  {
    // Params Class Color Quantity
    $colorParam = (object) [
      'border' => (object) [
        'light' => $product->quantity > 10 ? 'border-green-300' : 'border-red-300',
        'dark' => $product->quantity > 10 ? 'dark:border-green-600' : 'dark:border-red-700'
      ]
    ];
    //FormBuilder Button
    $buttonNavigation = new FormBuilder();
    $buttonNavigation->setIdForm("form-update-qty-{$product->getId()}");
    $buttonNavigation->setClassForm('flex flex-col justify-center items-center md:flex-row md:flex-nowrap gap-5 my-5');
    $buttonNavigation->setClassActionGroup('flex flex-row flex-nowrap gap-5')
      ->addField('button', 'upStock', [
        'label-false' => 1,
        'class' => "flex items-center justify-center align-center h-6 w-6 text-xl font-bold text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700",
        'value-button' => '<span class="sr-only">Boutton de diminution de la quantité</span>-',
        'attributes' => [
          'data-js' => 'handleUpdateQuantity,click',
          'data-action' => "down",
          'data-target-id' => "quantity",
          'data-id-form' => "form-update-qty-{$product->getId()}",
          'data-route' => "/api/Products/{$product->getId()}"
        ],
        'error-tooltip' => "Vous ne pouvez entrer que des nombre la valeur minimum et 0",
      ])->addField('number', 'quantity', [
        'class-label-group' => 'relative flex flex-nowrap text-gray-900 dark:text-white items-center gap-2',
        'label-false' => 1,
        'indicator' => 'quantité',
        'class' => "bg-gray-50 w-16 text-center border " . $colorParam->border->light . " text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 " . $colorParam->border->dark . " dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500",
        'attributes' => [
          'value' => $product->getQuantity() ?? 0,
          'data-js' => 'handleClick,change',
          'data-action' => 'verifyNumber',
          'data-min' => 0,
          'data-type' => 'number',
          'data-tooltip-target' => 'tooltip-warn-select_pages'
        ],
        'error-tooltip' => "Vous ne pouvez entrer que des nombre la valeur minimum et 0",
      ])->addField('button', 'dwStock', [
        'label-false' => 1,
        'value-button' => '<span class="sr-only">Boutton d\'augmentation de la quantité</span>+',
        'class' => "inline-flex items-center justify-center h-6 w-6 text-xl font-bold text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 translate-x translate-y",
        'attributes' => [
          'data-js' => 'handleUpdateQuantity,click',
          'data-action' => "up",
          'data-target-id' => "quantity",
          'data-id-form' => "form-update-qty-{$product->getId()}",
          'data-route' => "/api/Products/{$product->getId()}"
        ]
      ]);

    return $buttonNavigation;
  }
}
