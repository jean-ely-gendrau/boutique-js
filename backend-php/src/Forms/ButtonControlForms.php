<?php

namespace App\Boutique\Forms;

use Motor\Mvc\Builder\FormBuilder;

class ButtonControlForms
{

  public static function buttonPaginationProduct($pagination, $arguments, $serverName)
  {
    //FormBuilder Button
    $buttonNavigation = new FormBuilder();
    $buttonNavigation->setClassForm('flex flex-row flex-nowrap gap-5 my-5');
    $buttonNavigation->setClassActionGroup('flex flex-row flex-nowrap gap-5');
    $buttonNavigation->addElementAction('link', 'last_button', 'last_button', [
      'class' => "flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
      'label-false' => 1,
      'anchor' => 'Précédant',
      'attributes' => [
        'href' => $pagination['page_last'] ? "http://{$serverName}/produit/{$arguments['categoryName']}/{$pagination['page_last']}" : '#',
        'disabled' => $pagination['page_last'] ? '' : 'disabled',
      ]
    ]);

    $buttonNavigation->addField('number', 'select_pages', [
      'label-false' => 1,
      'class' => "flex items-center justify-center px-4 w-20 h-10 text-center text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white",
      'attributes' => [
        'value' => $arguments['page'] ?? 1,
      ]
    ]);

    $buttonNavigation->addField('button', 'number_pages', [
      'label-false' => 1,
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
        'href' => $pagination['page_next'] ? "http://{$serverName}/produit/{$arguments['categoryName']}/{$pagination['page_next']}" : '#',
        'disabled' => $pagination['page_next'] ? '' : 'disabled',
      ]
    ]);

    return $buttonNavigation;
  }
}
