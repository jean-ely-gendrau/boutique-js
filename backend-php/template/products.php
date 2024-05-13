<div class="font-[sans-serif]">
  <div class="p-4 mx-auto lg:max-w-6xl max-w-xl md:max-w-full">
    <h2 class="text-4xl font-extrabold text-gray-800 mb-12">Tous nos produits <?= $categoryName  ?></h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

      <?php foreach ($productAllSelect ?? [] as $product) : ?>

        <div class="bg-gray-100 rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all relative">
          <div id="<?= $product->id ?>" class="favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="18px" class="fill-gray-800 inline-block" viewBox="0 0 64 64">
              <path d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z" data-original="#000000"></path>
            </svg>
          </div>
          <div class="w-2/3 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8">
            <img src="https://readymadeui.com/images/coffee1.webp" alt="Product 1" class="h-full w-full object-contain" />
          </div>
          <div class="text-center mt-4">
            <h3 class="text-lg font-extrabold text-gray-800"><?= $product->name ?></h3>
            <h4 class="text-2xl text-gray-800 font-bold mt-4"><?= $product->price ?> <span class="text-gray-400 ml-2 font-medium"><?= $product?->pound ?></span>
            </h4>
            <button data-js="handelPost,click" data-route="http://<?= $serverName ?>/addtobasket/<?= $product->id ?>" type="button" class="w-full flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl">
              <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 512 512">
                <path d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0" data-original="#000000"></path>
              </svg>
              Ajouter au panier</button>
          </div>
        </div>

      <?php endforeach;
      var_dump($pagination)
      ?>

      <?php $productAllSelect ?? 'Aucun produit ne trouvé dans cette catégorie'; ?>

    </div>



    <div class="flex m-auto justify-center">
      <!-- Previous Button -->
      <a href="<?= $pagination['page_last'] ? "http://{$serverName}/produit/{$categoryName}/{$pagination['page_last']}" : '#' ?>" <?= $pagination['page_last'] ? '' : 'disabled' ?> class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        Précédant
      </a>

      <!-- Next Button -->
      <a href="<?= $pagination['page_next'] ? "http://{$serverName}/produit/{$categoryName}/{$pagination['page_next']}" : '#' ?>" <?= $pagination['page_next'] ? '' : 'disabled' ?> class="flex items-center justify-center px-3 h-8 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
        Suivant
      </a>
    </div>

  </div>
</div>