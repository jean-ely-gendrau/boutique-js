<section class="bg-acceuil">
  <div style="backdrop-filter: blur(1px)">

    <!-- bannière carouselhttps://<?= $serverName ?>/assets/images//TotalBanner.jpg -->
    <!-- <//?= $carousel ?> -->
  

<div
  id="carouselExampleCaptions"
  class="relative"
  data-carousel-init
  data-ride="carousel">
  <!--Carousel indicators-->
  <div
    class="absolute bottom-0 left-0 right-0 z-[2] mx-[15%] mb-4 flex list-none justify-center p-0"
    data-carousel-indicators>
    <button
      type="button"
      data-target="#carouselExampleCaptions"
      data-slide-to="0"
      data-carousel-active
      class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
      aria-current="true"
      aria-label="Slide 1"></button>
    <button
      type="button"
      data-target="#carouselExampleCaptions"
      data-slide-to="1"
      class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
      aria-label="Slide 2"></button>
    <button
      type="button"
      data-target="#carouselExampleCaptions"
      data-slide-to="2"
      class="mx-[3px] box-content h-[3px] w-[30px] flex-initial cursor-pointer border-0 border-y-[10px] border-solid border-transparent bg-white bg-clip-padding p-0 -indent-[999px] opacity-50 transition-opacity duration-[600ms] ease-[cubic-bezier(0.25,0.1,0.25,1.0)] motion-reduce:transition-none"
      aria-label="Slide 3"></button>
  </div>

  <!--Carousel items-->
  <div
    class="relative w-full overflow-hidden after:clear-both after:block after:content-['']">
    <!--First item-->
    <div
      class="relative float-left -mr-[100%] w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
      data-carousel-active
      data-carousel-item
      style="backface-visibility: hidden">
      <img
        src="https://<?= $serverName ?>/assets/images/banière/TotalBannerImage.jpg"
        class="block w-full"
        alt="..." />
      
    </div>
    <!--Second item-->
    <div
      class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
      data-carousel-item
      style="backface-visibility: hidden">
      <img
        src="https://<?= $serverName ?>/assets/images/banière/bannerTest.jpg"
        class="block w-full"
        alt="..." />
      
    </div>
    <!--Third item-->
    <div
      class="relative float-left -mr-[100%] hidden w-full transition-transform duration-[600ms] ease-in-out motion-reduce:transition-none"
      data-carousel-item
      style="backface-visibility: hidden">
      <img
        src="https://<?= $serverName ?>/assets/images/banière/teaBannerTest.jpg"
        class="block w-full"
        alt="..." />
      
    </div>
  </div>

  <!--Carousel controls - prev item-->
  <button
    class="absolute bottom-0 left-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
    type="button"
    data-target="#carouselExampleCaptions"
    data-slide="prev">
    <span class="inline-block h-8 w-8">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="h-6 w-6">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M15.75 19.5L8.25 12l7.5-7.5" />
      </svg>
    </span>
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Previous</span
    >
  </button>
  <!--Carousel controls - next item-->
  <button
    class="absolute bottom-0 right-0 top-0 z-[1] flex w-[15%] items-center justify-center border-0 bg-none p-0 text-center text-white opacity-50 transition-opacity duration-150 ease-[cubic-bezier(0.25,0.1,0.25,1.0)] hover:text-white hover:no-underline hover:opacity-90 hover:outline-none focus:text-white focus:no-underline focus:opacity-90 focus:outline-none motion-reduce:transition-none"
    type="button"
    data-target="#carouselExampleCaptions"
    data-slide="next">
    <span class="inline-block h-8 w-8">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
        stroke-width="1.5"
        stroke="currentColor"
        class="h-6 w-6">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M8.25 4.5l7.5 7.5-7.5 7.5" />
      </svg>
    </span>
    <span
      class="!absolute !-m-px !h-px !w-px !overflow-hidden !whitespace-nowrap !border-0 !p-0 ![clip:rect(0,0,0,0)]"
      >Next</span
    >
  </button>
</div>
    <!-- //NOTE - Ajouter une description de la boutique -->

    



    <!-- //NOTE - Début des Slider -->
    <div class="sm:w-full lg:max-w-6xl mx-auto mt-8 md:mt-20">
       <div class="lg:flex lg:align-items bg-gray-100 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">

         <div class="text-gray-700 dark:text-gray-200 ">
           
           <h2 class="font-bold text-xl md:text-3xl lg:text-4xl text-center text-gray-700 dark:text-gray-200 bg-gray-100 p-2">
             Découvrez l'univers du <span class="text-red-800">Café</span> et du <span class="text-green-600">Thé</span>
            </h2>
            <p class="text-sm md:text-xl font-semibold lg:text-2xl text-center text-gray-700 dark:text-gray-200 bg-gray-100 p-2">Chez <span class="text-green-600">Tea'</span><span class="text-red-800">Coffee</span>, nous sommes passionnés par l'art du <span class="text-red-800">Café</span> et du <span class="text-green-600">Thé</span>. En tant que spécialistes dans la vente de cafés d'exception et de thés très recherchés, nous vous invitons à un voyage sensoriel à travers les saveurs et les arômes provenant des quatre coins du monde.</p>
          </div>  
          <img src="https://<?= $serverName ?>/assets/images/banière/testBannerAllProduct.png" class="w-[15rem] mx-auto md:w-[25rem] lg:w-[30rem]" alt="">
        </div>
    <!-- </div> -->
    <div class="mx-auto lg:w-fit">
      <?= $product ?>
    </div>

    <h2 class="mt-12 w-64 text-gray-700 dark:text-gray-200 bg-gray-100 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de café</h2>
    <div class="mx-auto">
      <?= $productsCoffee ?>
    </div>


    <h2 class="mt-12 w-64 text-gray-700 dark:text-gray-200 bg-gray-100 p-2 rounded-xl shadow-[3px_3px_8px_0px_rgba(0,0,0,0.6)]">Notre sélection de thé</h2>
    <div class="mx-auto">
      <?= $productsTea ?>
    </div>
</div>
  </div>
</section>