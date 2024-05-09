<?php
echo $newModalUser?->render() ?? "";
?>
<section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5 mx-2">
  <div class="px-4 mx-auto max-w-screen-2xl lg:px-12 bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
      <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
        <div class="flex items-center flex-1 space-x-4">
          <h5>
            <span class="text-gray-500">Utilisateurs Total:</span>
            <span class="dark:text-white"><?= $paginatePerPage['total_result'] ?></span>
          </h5>
        </div>
        <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
          <?= $buttonModalUser ?>

          <!--
          <button type="button" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="none" viewbox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
            </svg>
            Rafraichir
          </button>
          <button type="button" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            Export
          </button> -->
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
                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Désactiver le compte</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Supprimer Utilisateur</a>
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
              <input type="text" id="table-search-users" class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for users">
            </div>
          </div>
          <!-- START TABLE -->
          <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th scope="col" class="p-4">
                  <div class="flex items-center">
                    <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checkbox-all-search" class="sr-only">checkbox</label>
                  </div>
                </th>
                <th scope="col" class="px-6 py-3">
                  Membre
                </th>
                <th scope="col" class="px-6 py-3 hidden md:table-cell">
                  âge
                </th>
                <th scope="col" class="px-6 py-3 hidden md:table-cell">
                  rôle
                </th>
                <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                  Inscrit le
                </th>
                <th scope="col" class="px-6 py-3">
                  Action
                </th>
              </tr>
            </thead>
            <tbody>
              <!-- START TR -->
              <?php foreach ($selectAllPaginate as $idKey => $user) : ?>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                  <td class="w-4 p-4">
                    <div class="flex items-center">
                      <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                      <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                    </div>
                  </td>
                  <td scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                    <?= $user->avatars ? '<img class="w-10 h-10 hidden md:visible rounded-full" src="' . $user->avatars . '" alt="' . $user->full_name . '">' : '<p class="justify-center items-center rounded-full border hidden md:flex border-gray-300 bg-blue-500 text-sm h-10 w-10">' . ucfirst($user->full_name[0]) . '</p>'; ?>
                    <div class="ps-3">
                      <?= $newModalUser->renderOpenButton($user->full_name, [
                        'type' => 'a',
                        'class' =>
                        'text-sm md:text-base font-semibold',
                        'data-js' => 'handleViewHtml,click',
                        'data-route' => '/api-html/template/profile/' . $user->id . '',
                        'data-target-id' => 'form-registration',
                      ]); ?>
                      <div class="text-xs md:text-sm truncate w-20 hover:text-pre font-normal text-gray-500"><?= $user->email ?></div>
                    </div>
                  </td>
                  <td class="px-6 py-4 hidden md:table-cell">
                    <?= $user->getAge() ?> ans
                  </td>
                  <td class="px-6 py-4 hidden md:table-cell">
                    <div class="flex items-center">
                      <!-- SVG/ROLE -->
                      <?php if ($user->role === 'user') : ?>
                        <svg fill="#000000" class="w-6 h-6 md:w-8 md:h-8 fill-black dark:fill-white me-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <g>
                              <g>
                                <path d="M454.275,85.672c-68.879,0-116.732-22.029-144.749-40.51c-30.433-20.075-44.786-40.46-44.913-40.641 c-1.944-2.83-5.16-4.512-8.593-4.521c-0.009,0-0.018,0-0.027,0c-3.422,0-6.636,1.688-8.589,4.499 c-0.141,0.204-14.495,20.589-44.927,40.664c-28.016,18.481-75.87,40.51-144.748,40.51c-5.771,0-10.449,4.678-10.449,10.449 v158.065c0,0.079,0.001,0.16,0.002,0.239c1.056,46.063,4.087,87.558,30.591,128.922c29.482,46.013,84.693,86.587,173.75,127.69 c1.39,0.642,2.884,0.961,4.378,0.961s2.99-0.321,4.378-0.961c89.058-41.103,144.268-81.676,173.751-127.69 c26.504-41.364,29.535-82.859,30.591-128.922c0.001-0.079,0.002-0.16,0.002-0.239V96.121 C464.724,90.35,460.046,85.672,454.275,85.672z M443.826,254.068c-1.02,44.329-3.692,81.175-27.291,118.006 c-26.767,41.774-77.836,79.317-160.533,117.957c-82.696-38.639-133.766-76.183-160.532-117.957 c-23.6-36.83-26.272-73.677-27.291-118.006V106.411c69.059-2.128,117.68-25.055,146.76-44.435 c19.66-13.102,33.152-26.244,41.063-35.04c7.911,8.796,21.403,21.938,41.063,35.04c29.081,19.381,77.701,42.308,146.761,44.435 V254.068z"></path>
                              </g>
                            </g>
                            <g>
                              <g>
                                <path d="M208.563,99.101c-2.665-5.119-8.974-7.109-14.093-4.446c-28.265,14.708-60.078,24.569-94.553,29.307 c-5.717,0.786-9.715,6.057-8.929,11.775c0.719,5.234,5.2,9.027,10.339,9.027c0.474,0,0.954-0.032,1.436-0.098 c36.855-5.066,70.955-15.654,101.354-31.472C209.236,110.53,211.226,104.22,208.563,99.101z"></path>
                              </g>
                            </g>
                            <g>
                              <g>
                                <path d="M240.65,77.271c-3.424-4.647-9.965-5.637-14.61-2.214c-1.215,0.896-2.468,1.799-3.758,2.708 c-4.715,3.328-5.839,9.847-2.512,14.563c2.036,2.883,5.265,4.424,8.546,4.424c2.083,0,4.185-0.621,6.016-1.913 c1.409-0.995,2.776-1.981,4.103-2.958C243.082,88.458,244.073,81.917,240.65,77.271z"></path>
                              </g>
                            </g>
                            <g>
                              <g>
                                <path d="M256.001,123.865c-74.902,0-135.84,60.938-135.84,135.841c0,74.902,60.938,135.839,135.84,135.839 s135.84-60.937,135.84-135.839C391.841,184.803,330.903,123.865,256.001,123.865z M256.001,374.646 c-36.545,0-69.16-17.145-90.228-43.813c19.88-18.358,45.799-30.142,73.897-33.436c4.839-0.568,8.643-4.403,9.171-9.247 c0.528-4.843-2.362-9.408-6.964-11.004c-17.332-6.009-28.978-22.375-28.978-40.723c0-23.766,19.335-43.101,43.102-43.101 c23.767,0,43.102,19.335,43.102,43.101c0,18.348-11.646,34.712-28.979,40.723c-4.603,1.596-7.492,6.161-6.964,11.004 c0.528,4.843,4.332,8.679,9.171,9.247c28.098,3.295,54.017,15.078,73.898,33.436C325.16,357.501,292.546,374.646,256.001,374.646z M300.941,281.985c11.926-11.776,19.06-28.061,19.06-45.561c0-35.289-28.71-63.999-64-63.999c-35.29,0-64,28.71-64,63.999 c0,17.499,7.136,33.784,19.06,45.561c-21.163,6.237-40.58,16.859-56.815,31.125c-8.414-15.966-13.186-34.137-13.186-53.403 c0-63.38,51.563-114.942,114.941-114.942s114.941,51.562,114.941,114.941c0,19.266-4.772,37.437-13.186,53.404 C341.521,298.843,322.104,288.222,300.941,281.985z"></path>
                              </g>
                            </g>
                          </g>
                        </svg>
                        user
                      <?php elseif ($user->role === 'admin') : ?>
                        <svg class="w-6 h-6 md:w-8 md:h-8 fill-black dark:fill-white me-1" version=" 1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <g>
                              <g>
                                <path d="M235.082,392.745c-5.771,0-10.449,4.678-10.449,10.449v4.678c0,5.771,4.678,10.449,10.449,10.449 c5.77,0,10.449-4.678,10.449-10.449v-4.678C245.531,397.423,240.853,392.745,235.082,392.745z"></path>
                              </g>
                            </g>
                            <g>
                              <g>
                                <path d="M492.948,313.357l-31.393-25.855c1.58-10.4,2.38-20.968,2.38-31.502c0-10.534-0.8-21.104-2.381-31.504l31.394-25.856 c10.032-8.262,12.595-22.42,6.099-33.66L456.35,91.029c-4.704-8.173-13.479-13.25-22.903-13.25c-3.19,0-6.326,0.573-9.302,1.695 l-38.109,14.274c-16.546-13.286-34.848-23.869-54.55-31.54l-6.683-40.082C322.676,9.306,311.701,0,298.704,0h-85.408 C200.3,0,189.324,9.307,187.2,22.119l-6.684,40.088c-19.703,7.673-38.007,18.255-54.553,31.542L87.898,79.492 c-2.999-1.138-6.14-1.715-9.338-1.715c-9.414,0-18.191,5.074-22.903,13.241l-42.702,73.96 c-6.499,11.244-3.935,25.403,6.097,33.664l31.394,25.855c-1.58,10.4-2.38,20.969-2.38,31.503c0,10.534,0.8,21.103,2.38,31.503 l-31.394,25.856c-10.032,8.262-12.595,22.42-6.099,33.66l42.703,73.963c4.716,8.171,13.492,13.247,22.904,13.247 c3.205,0,6.352-0.581,9.294-1.703l38.107-14.275c16.547,13.287,34.85,23.87,54.551,31.541l6.682,40.075 C189.316,502.692,200.293,512,213.297,512h85.408c12.991,0,23.967-9.304,26.096-22.118l6.683-40.089 c19.705-7.673,38.008-18.255,54.554-31.542l38.07,14.261c2.999,1.137,6.141,1.713,9.336,1.713c9.411,0,18.185-5.074,22.9-13.241 l42.703-73.962C505.543,335.776,502.979,321.619,492.948,313.357z M298.704,491.102H245.53v-49.427 c0-5.771-4.678-10.449-10.449-10.449c-5.771,0-10.449,4.678-10.449,10.449v49.427h-10.922V376.504 c13.606,4.844,28.061,7.375,42.865,7.382c0.003,0,0.066,0,0.07,0c14.852,0,29.325-2.528,42.928-7.376v114.515h0.001 C299.289,491.069,299,491.102,298.704,491.102z M256.642,362.988h-0.057c-58.964-0.029-106.933-48.026-106.932-106.99 c0.001-34.314,16.175-65.814,43.158-85.745v76.229c0,3.671,1.926,7.072,5.073,8.96l53.381,32.027 c3.309,1.984,7.443,1.984,10.752,0l53.381-32.027c3.147-1.889,5.073-5.29,5.073-8.96v-76.229 c26.983,19.931,43.159,51.432,43.157,85.747c0,28.528-11.143,55.382-31.374,75.614 C312.022,351.846,285.169,362.988,256.642,362.988z M480.949,336.57l-42.705,73.965c-1.326,2.296-4.122,3.423-6.769,2.42 l-43.772-16.397c-3.557-1.331-7.555-0.63-10.444,1.834c-16.925,14.428-36.026,25.589-56.79,33.212v-64.779 c9.585-5.551,18.513-12.386,26.56-20.434c24.179-24.18,37.495-56.281,37.495-90.391c0.001-48.242-26.729-91.831-69.76-113.754 c-3.239-1.651-7.103-1.498-10.203,0.401c-3.099,1.9-4.989,5.274-4.989,8.909v89.011l-42.932,25.759l-42.932-25.759v-89.011 c0-3.635-1.89-7.009-4.989-8.909c-3.099-1.899-6.963-2.05-10.203-0.401c-43.03,21.922-69.76,65.51-69.762,113.752 c-0.001,34.743,13.583,67.154,38.247,91.26c7.858,7.68,16.53,14.23,25.809,19.585v65.235 c-21.258-7.63-40.795-18.958-58.071-33.684c-1.922-1.638-4.333-2.497-6.78-2.497c-1.232,0-2.473,0.217-3.663,0.664l-43.83,16.419 c-0.613,0.234-1.255,0.353-1.905,0.353c-1.969,0-3.81-1.071-4.805-2.796l-42.706-73.968c-1.365-2.361-0.822-5.337,1.288-7.076 L68.389,299.8c2.926-2.411,4.318-6.216,3.635-9.944c-2.03-11.12-3.061-22.509-3.061-33.856c0-11.346,1.03-22.736,3.063-33.854 c0.681-3.729-0.709-7.535-3.636-9.944l-36.051-29.691c-2.112-1.74-2.654-4.716-1.287-7.08l42.705-73.966 c1.323-2.294,4.109-3.429,6.769-2.419l43.772,16.396c3.555,1.33,7.554,0.63,10.444-1.833 c17.417-14.847,37.129-26.244,58.589-33.876c3.576-1.272,6.182-4.382,6.805-8.126l7.679-46.059 c0.446-2.694,2.752-4.649,5.482-4.649h85.408c2.73,0,5.036,1.955,5.485,4.656l7.679,46.053c0.624,3.744,3.23,6.856,6.806,8.126 c21.459,7.631,41.17,19.027,58.586,33.874c2.89,2.463,6.888,3.165,10.444,1.833l43.794-16.405c0.631-0.238,1.287-0.358,1.95-0.358 c1.97,0,3.805,1.064,4.798,2.789l42.706,73.967c1.365,2.361,0.822,5.337-1.288,7.076l-36.052,29.692 c-2.926,2.411-4.318,6.215-3.635,9.944c2.03,11.118,3.061,22.509,3.061,33.855c0,11.346-1.03,22.735-3.063,33.853 c-0.681,3.728,0.709,7.535,3.636,9.944l36.051,29.691C481.774,331.227,482.316,334.205,480.949,336.57z"></path>
                              </g>
                            </g>
                          </g>
                        </svg>
                        admin
                      <?php endif; ?>
                    </div>
                  </td>
                  <td class="px-6 py-4 hidden lg:table-cell">
                    <?= $user->created_at ?>
                  </td>
                  <td class="px-6 py-4">
                    <button id="dropdownMenuIconHorizontalButton-<?= $idKey ?>" data-dropdown-toggle="dropdownDotsHorizontal-<?= $idKey ?>" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                        <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                      </svg>
                    </button>

                    <!-- user action menu -->
                    <div id="dropdownDotsHorizontal-<?= $idKey ?>" class="z-10 hidden border border-gray-400 bg-gray-100 divide-y  divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600 dark:border-gray-300">
                      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconHorizontalButton-<?= $idKey ?>">
                        <li>
                          <?= $newModalUser->renderOpenButton('
                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                  <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                </svg> Profil', [
                            'type' => 'button',
                            'class' =>
                            'flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white whitespace-nowrap',
                            'data-js' => 'handleViewHtml,click',
                            'data-route' => '/api-html/template/profile/' . $user->id . '',
                            'data-target-id' => 'form-registration',
                          ]); ?>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Commandes</a>
                        </li>
                        <li>
                          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Comments & Notes</a>
                        </li>
                      </ul>
                      <div class="py-2">
                        <a href="#" class="flex items-center p-3 text-sm font-medium text-red-600 border-t border-gray-200 rounded-b-lg bg-gray-50 dark:border-gray-600 hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-red-500 hover:underline">
                          <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-6a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2Z" />
                          </svg>
                          Supprimer <?= $user->full_name ?>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- PAGINATION -->
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