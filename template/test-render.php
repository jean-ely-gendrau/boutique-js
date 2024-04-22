<section class="bg-acceuil">
<div style="backdrop-filter: blur(1px)">
<!-- box-shadow: 3px 3px 9px 0px gray; #808080-->
  
  <div id="default-carousel" class="relative md:max-w-[85rem] mx-auto" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-[34rem] w-11/12 mx-auto">
      <!-- Item 1 -->
      <div class="hidden duration-900 ease-in-out" data-carousel-item>
        <div
          class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
        >
          <div class="max-h-[35rem]">
            <img
              src="http://<?= $serverName ?>/assets/images/TotalBanner.jpg"
              alt="image de présentation de la boutique"
              class="mx-auto rounded-3xl mt-20"
            />
            <div class="flex flex-column -translate-y-48 justify-evenly">
              <div
                class="translate-x-[-300px] translate-y-[-250px] fixed bg-gray-100 p-4 rounded-[40px]"
              >
                <img
                  src="http://<?= $serverName ?>/assets/images/logo.png"
                  alt="logo de la boutique"
                  class=""
                />
              </div>
              <div
                class="bg-gray-100 p-4 w-[600px] rounded-[40px] translate-x-64"
              >
                <p class="text-2xl">Découvrez l'excellence chez Tea'Coffee :</p>
                <p class="text-2xl text-center">
                  Une sélection exquise de café et de thé pour
                </p>
                <p class="text-2xl text-end">
                  des moments de dégustation inoubliables.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Item 2 -->
      <div class="hidden duration-900 ease-in-out" data-carousel-item>
        <img
          src="http://<?= $serverName ?>/assets//images//banière//headerTeaPage.jpg"
          class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
          alt="..."
        />
      </div>
      <!-- Item 3 -->
      <div class="hidden duration-900 ease-in-out" data-carousel-item>
        <img
          src="http://<?= $serverName ?>/assets//images//banière//hearderCoffeePage.jpg"
          class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
          alt="..."
        />
      </div>
      <!-- Item 4 -->
      <div class="hidden duration-900 ease-in-out" data-carousel-item>
        <img
          src="http://<?= $serverName ?>/assets//images//banière//hearderCoffeePage2.jpg"
          class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
          alt="..."
        />
      </div>
      <!-- Item 5 -->
      <div class="hidden duration-900 ease-in-out" data-carousel-item>
        <img
          src="http://<?= $serverName ?>/assets//images//banière//tea.webp"
          class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
          alt="..."
        />
      </div>
    </div>
    <!-- Slider indicators -->
    <div
      class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse"
    >
      <button
        type="button"
        class="w-3 h-3 rounded-full"
        aria-current="true"
        aria-label="Slide 1"
        data-carousel-slide-to="0"
      ></button>
      <button
        type="button"
        class="w-3 h-3 rounded-full"
        aria-current="false"
        aria-label="Slide 2"
        data-carousel-slide-to="1"
      ></button>
      <button
        type="button"
        class="w-3 h-3 rounded-full"
        aria-current="false"
        aria-label="Slide 3"
        data-carousel-slide-to="2"
      ></button>
      <button
        type="button"
        class="w-3 h-3 rounded-full"
        aria-current="false"
        aria-label="Slide 4"
        data-carousel-slide-to="3"
      ></button>
      <button
        type="button"
        class="w-3 h-3 rounded-full"
        aria-current="false"
        aria-label="Slide 5"
        data-carousel-slide-to="4"
      ></button>
    </div>
    <!-- Slider controls  group-focus:ring-4 group-focus:ring-gray-300 dark:group-focus:ring-gray-800/70 group-focus:outline-none -->
    <button
      type="button"
      class="absolute top-0 start-0 z-30 flex items-center justify-center h-full cursor-pointer"
      data-carousel-prev
    >
      <span
        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-800/30 focus:outline-none focus:ring"
      >
        <svg
          class="w-8 h-8 text-black dark:text-gray-800 rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M5 1 1 5l4 4"
          />
        </svg>
        <span class="sr-only">Previous</span>
      </span>
    </button>
    <button
      type="button"
      class="absolute top-0 end-0 z-30 flex items-center justify-center h-full cursor-pointer group focus:outline-none"
      data-carousel-next
    >
      <span
        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-800/30 focus:outline-none focus:ring"
      >
        <svg
          class="w-8 h-8 text-black dark:text-gray-800 rtl:rotate-180"
          aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 6 10"
        >
          <path
            stroke="currentColor"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="m1 9 4-4-4-4"
          />
        </svg>
        <span class="sr-only">Next</span>
      </span>
    </button>
  </div>

  <!------------------- Image de banière ----------------------------->
  <div class="max-h-[35rem]">
    <img
      src="http://<?= $serverName ?>/assets/images/TotalBanner.jpg"
      alt="image de présentation de la boutique"
      class="mx-auto rounded-3xl mt-20"
    />
    <div class="flex flex-column -translate-y-48 justify-evenly">
      <div
        class="translate-x-[-300px] translate-y-[-250px] fixed bg-gray-100 p-4 rounded-[40px]"
      >
        <img
          src="http://<?= $serverName ?>/assets/images/logo.png"
          alt="logo de la boutique"
          class=""
        />
      </div>
      <div class="bg-gray-100 p-4 w-[600px] rounded-[40px] translate-x-64">
        <p class="text-2xl">Découvrez l'excellence chez Tea'Coffee :</p>
        <p class="text-2xl text-center">
          Une sélection exquise de café et de thé pour
        </p>
        <p class="text-2xl text-end">
          des moments de dégustation inoubliables.
        </p>
      </div>
    </div>
  </div>

  <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">
      Dernier produit de la boutique
    </h2>
  </div>

  <!-- Appelle du render Slider -->
  <?= $product ?>

  <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Notre sélection de café</h2>
  </div>

  <?= $productsCoffee ?>

  <div class="mx-auto flex justify-start max-w-6xl">
    <h2 class="bg-gray-100 ml-10 p-2 rounded-xl">Notre sélection de thé</h2>
  </div>

  <?= $productsTea ?>
</div>
</section>
