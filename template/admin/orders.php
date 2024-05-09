<?php


echo $newModalOrder?->render() ?? "";
/*
 <button type="button" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
<svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
</svg>
Update stocks 1/250
</button> 
 <button type="button" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
<svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
</svg>
Export
</button> 
*/
?>
<section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5 mt-16">
  <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
      <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
        <div class="flex items-center flex-1 space-x-4">
          <h5>
            <span class="text-gray-500">Commandes Total:</span>
            <span class="dark:text-white"><?= $paginatePerPage['total_result'] ?></span>
          </h5>
          <h5>
            <span class="text-gray-500">Total Chiffres Affaire:</span>
            <span class="dark:text-white"></span>
          </h5>
        </div>
        <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
          <?= $buttonModalOrder ?>
          <!-- Button -->
        </div>
      </div>
      <div class="overflow-x-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <div class="flex px-4  items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-800">
            <div>
              <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction" class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                <span class="sr-only">Action button</span>
                Action
                <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div id="dropdownAction" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownActionButton">
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Campagne Email</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Modifier le status</a>
                  </li>
                  <li>
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Suspendre la commande</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Supprimer la commande</a>
                </div>
              </div>
            </div>
            <label for="table-search" class="sr-only">Recherche</label>
            <div class="relative">
              <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
              </div>
              <input type="text" id="table-search-orders" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Chercher dans les commandes">
            </div>
          </div>
          <!-- START TABLE -->
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="py-3">
                  <div class="flex items-center">
                    <input id="checkbox-all" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all" class="sr-only">checkbox</label>
                  </div>
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                  Client
                </th>
                <th scope="col" class="px-3 md:px-6 py-3 hidden lg:table-cell">
                  Panier/Status
                </th>
                <th scope="col" class="px-3 md:px-6 py-3 hidden lg:table-cell">
                  Crée le
                </th>
                <th scope="col" class="px-3 md:px-6 py-3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <!-- START TR -->
              <?php foreach ($selectAllPaginate as $idKey => $order) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <!-- CHECKBOX -->
                  <td class="w-4 px-3 md:px-6 py-4">
                    <div class="flex items-center">
                      <input id="checkbox-table-search-<?= $order->id_orders ?>" type="checkbox" onclick="event.stopPropagation()" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="checkbox-table-search-<?= $order->id_orders ?>" class="sr-only">checkbox</label>
                    </div>
                  </td>
                  <td scope="row" class="flex items-center px-3 md:px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $order->avatars ? '<img class="w-10 h-10 hidden md:visible rounded-full" src="' . $order->avatars . '" alt="' . $order->full_name . '">' : '<p class="justify-center items-center rounded-full border hidden md:flex border-gray-300 bg-blue-500 text-sm h-10 w-10">' . ucfirst($order->full_name[0]) . '</p>'; ?>
                    <div class="ps-3">
                      <?php echo $newModalOrder->renderOpenButton("{$order->full_name}", [
                        'type' => 'a',
                        'data-js' => 'handleViewHtml,click',
                        'data-route' => '/api-html/form/orders',
                        'data-target-id' => 'body-modal-add-order-adm',
                      ]) ?>
                    </div>
                    <div class="text-xs md:text-sm truncate w-32 hover:text-clip md:w-full md:text-wrap font-normal text-gray-500"><?= $order->email ?></div>
                  </td>
                  <td class="px-3 md:px-6 py-4 hidden lg:table-cell">
                    <div class="flex items-center space-x-3">
                      <?php
                      /** @var \App\Boutique\Forms\SelectBoxForms $selectBoxStatus  */
                      if ($order->basket === 1) : ?>
                        <svg class="w-6 h-6 md:h-10 md:w-10 stroke-black dark:stroke-white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <defs>
                              <style>
                                .cls-1 {
                                  fill: none;
                                  stroke-miterlimit: 10;
                                  stroke-width: 1.71px;
                                }
                              </style>
                            </defs>
                            <g id="cart">
                              <circle class="cls-1" cx="10.07" cy="20.59" r="1.91"></circle>
                              <circle class="cls-1" cx="18.66" cy="20.59" r="1.91"></circle>
                              <path class="cls-1" d="M.52,1.5H3.18a2.87,2.87,0,0,1,2.74,2L9.11,13.91H8.64A2.39,2.39,0,0,0,6.25,16.3h0a2.39,2.39,0,0,0,2.39,2.38h10"></path>
                              <polyline class="cls-1" points="7.21 5.32 22.48 5.32 22.48 7.23 20.57 13.91 9.11 13.91"></polyline>
                            </g>
                          </g>
                        </svg>
                      <?php endif;
                      echo $selectBoxStatus::selectStatusOrders($order, $getEnumStatus);
                      ?>
                    </div>
                  </td>
                  <td class="px-3 md:px-6 py-4 hidden lg:table-cell font-semibold text-gray-900 dark:text-white">
                    <?= $order->created_at ?>
                  </td>
                  <td class="px-3 md:px-6 py-4">
                    <button id="dropdownMenuIconHorizontalButton-<?= $idKey ?>" data-dropdown-toggle="dropdownDotsHorizontal-<?= $idKey ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                      </svg>
                    </button>

                    <!-- order action menu -->
                    <div id="dropdownDotsHorizontal-<?= $idKey ?>" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton-<?= $idKey ?>">
                        <li>
                          <?= $newModalOrder->renderOpenButton('Détails', [
                            'type' => 'a',
                            'class' =>
                            'block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white',
                            'data-js' => 'handleViewHtml,click',
                            'data-route' => '/api-html/form/orders',
                            'data-target-id' => 'body-modal-add-order-adm',
                          ]); ?>
                        </li>
                      </ul>
                      <div class="py-2">
                        <a href="#" class="flex items-center p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
                          <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z" />
                          </svg>
                          Supprimer la commande
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>

              <?php endforeach; ?>
              <!-- END TR -->
            </tbody>
          </table>
          <!-- END TABLE -->

        </div>
        <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0" aria-label="Table navigation">
          <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            <?= $tableName ?>
            <span class="font-semibold text-gray-900 dark:text-white">1-10</span>
            sur
            <span class="font-semibold text-gray-900 dark:text-white"><?= $paginatePerPage['total_result'] ?></span>
          </span>
          <ul class="inline-flex items-stretch -space-x-px">
            <li>
              <a href="<?php $paginatePerPage['page_last'] !== false
                          ? "{$uri}/{$paginatePerPage['page_last']}"
                          : '#'; ?>" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="sr-only">précédent</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>
            <?php for ($countPage = 1; $countPage <= $paginatePerPage['number_pages']; $countPage++) : ?>
              <li>
                <a href="<?= "{$uri}/{$countPage}" ?>" class="flex items-center justify-center px-3 py-2 text-sm leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $countPage ?></a>
              </li>
            <?php endfor; ?>
            <li>
              <a href="<?= $paginatePerPage['page_next'] !== false
                          ? "{$uri}/{$paginatePerPage['page_next']}"
                          : '#' ?> " class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <span class="sr-only">Suivant</span>
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
</section>