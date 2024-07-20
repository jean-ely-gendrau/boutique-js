<div class="font-[sans-serif]">
  <div class="p-4 mx-auto lg:max-w-6xl max-w-xl md:max-w-full">
    <h2 class="text-center text-4xl font-extrabold text-gray-800 mb-12">Tous nos <?php echo ($categoryName == 1) ? 'Café' : 'Thé'; ?></h2>
    
    <div class="mx-auto flex max-w-6xl">
      <?= $buttonFilter->render() ?>
    </div>


    <div id="resultat" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> 
      
      <?php foreach ($productAllSelect ?? [] as $product): ?>
        <?php $product->user_has_product === 1 ? $inFav = 'inFav ' : $inFav = null; ?>
        <div class="product-container bg-gray-100 rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all relative">
          <div id="<?= $product->id ?>"
            class="<?= $inFav ?>favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4">
            <svg class="fill-gray-800 inline-block" width="22px" viewBox="0 0 192 192" xmlns="https://www.w3.org/2000/svg"
              xml:space="preserve" fill="none">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                <path
                  d="M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z"
                  style="clip-rule:evenodd;display:inline;fill:none;stroke:rgb(235, 55, 55);stroke-width:12;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2;stroke-dasharray:none;stroke-opacity:1">
                </path>
              </g>
            </svg>
          </div>
          <div id="<?= $product->id ?>"
            class="article-image-container w-2/3 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8 article-image">
            <img src="<?= $product?->image_main ?? "https://{$serverName}/assets/images/tea-coffee.png" ?>"
              alt="image <?= $product->name ?>" class="article-image h-full w-full object-contain" data-url="<?= $product?->image_main ?? "https://{$serverName}/assets/images/tea-coffee.png" ?>" />
          </div>
          <div class="product text-center mt-4" data-price='<?= $product->price ?>' data-id='<?= $product->id ?>' data-name='<?= $product->name ?>'>
            <h3 id="<?= $product->id ?>" class="article-name text-lg font-extrabold text-gray-800"><?= $product->name ?>
            </h3>
            <h4 class="text-2xl text-gray-800 font-bold mt-4"><?= $product->price ?> € <span
                class="text-gray-400 ml-2 font-medium"><?= $product?->pound ?></span>
            </h4>
            <button data-js='handlePost,click' data-route='/addtobasket' data-body-param="{product_id: '<?= $product->id ?>'}"
              type="button"
              class="add-to-cart w-full flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl">
              <svg xmlns="https://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 512 512">
                <path
                  d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                  data-original="#000000"></path>
              </svg>
              Ajouter au panier</button>
          </div>
        </div>

      <?php endforeach; ?>

      <?php $productAllSelect ?? 'Aucun produit ne trouvé dans cette catégorie'; ?>

    </div>

    <p id="paramsResarch">
    </p>

    <div class="mx-auto flex max-w-6xl">
      <?= $buttonFilter->render() ?>
    </div>

    <div class="flex justify-evenly">
      <?= $buttonNavigation->render() ?>
    </div>

  </div>
</div>