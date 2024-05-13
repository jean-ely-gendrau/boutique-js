<?php

namespace App\Boutique\Forms;

use App\Boutique\Models\Orders;
use Motor\Mvc\Builder\FormBuilder;

class SelectBoxForms
{

  public static function selectStatusOrders(Orders $orders, mixed $status)
  {
    $formSelectStatus = new FormBuilder();
    $formSelectStatus->addField('select', 'status-orders', [
      'label-false' => 1,
      'class-label-group' => 'flex flex-col w-full',
      'class' =>
      'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
      'class-label' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white',
      'options-selected' =>  $orders->getStatus(),
      'options-select-array' => $status,
    ]); // Champs SELECT

    return $formSelectStatus->render();
  }
}
