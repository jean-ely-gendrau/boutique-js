<!------------------- Image de banière ----------------------------->
<div class="max-h-[35rem]">
  <img src="http://<?= $serverName ?>/assets/images/TotalBanner.jpg" alt="image de présentation de la boutique"
  class="mx-auto rounded-3xl mt-20"/>
  <div class="flex flex-column -translate-y-48 justify-evenly">
    <div  class="translate-x-[-300px] translate-y-[-250px] fixed bg-gray-100 p-4 rounded-[40px]">
      <img src="http://<?= $serverName ?>/assets/images/logo.png" alt="logo de la boutique"
      class=""/>
    </div>
    <div class="bg-gray-100 p-4 w-[600px] rounded-[40px] translate-x-64">
      <p class="text-2xl">Découvrez l'excellence chez Tea'Coffee :</p>
      <p class="text-2xl text-center">Une sélection exquise de café et de thé pour</p>
      <p class="text-2xl text-end">des moments de dégustation inoubliables.</p>
    </div>
  </div>
</div>



<div class="mx-auto flex justify-start max-w-6xl">
  <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Dernier produit de la boutique</h2>
</div>
  <div id="menu" class="relative flex justify-center">
      <ul class="block list-none p-0 whitespace-nowrap overflow-hidden max-w-6xl px-[20px]">
        <?php foreach ($product->AllProduct() as $productItem): ?>
        <div
          class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-xl"
        >
          <div
            class="bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="18px"
              class="fill-gray-800 inline-block"
              viewBox="0 0 64 64"
            >
              <path
                d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 div0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
                data-original="#000000"
              ></path>
            </svg>
          </div>
          <img src="http://<?= $serverName ?>/assets/images/<?= $productItem[
    'images'
]['main'] ?>" alt="<?= $productItem[
    'name'
] ?>" class="w-32 h-28 mx-auto mt-12" />
          
          <p class="mt-3 font-bold"><?= $productItem['name'] ?></p>
          <div class="flex justify-center">
            <p class="mt-3 font-bold mr-2"><?= $productItem['price'] ?>€</p>
            <p class="mt-3 font-medium text-gray-300"><?= $productItem[
                'price'
            ] ?>€</p>
          </div>
          <div>
            <button
              type="button"
              class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full"
            >
              Add to cart
            </button>
          </div>
        </div>
      <?php endforeach; ?>
      </ul> 
        <!-- Boutton Précédent/Suivant -->
      <div id="nav" class="absolute top-0 w-[1152px]">
        <div
          id="prev"
          class="absolute left-0 inline-block p-1 bg-gray-200 text-white my-40 cursor-pointer rounded-full"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
          >
            <polygon
              points="15.293 3.293 6.586 12 15.293 20.707 16.707 19.293 9.414 12 16.707 4.707 15.293 3.293"
            />
          </svg>
        </div>
        <div
          id="next"
          class="absolute right-0 inline-block p-1 bg-gray-200 text-white my-40 cursor-pointer rounded-full"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
          >
            <polygon
              points="7.293 4.707 14.586 12 7.293 19.293 8.707 20.707 17.414 12 8.707 3.293 7.293 4.707"
            />
          </svg>
        </div>
      </div>
    </div>

    <script src="http://<?= $serverName ?>/assets/js/scrollButtonProduct.js"></script>