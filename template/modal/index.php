<?php

/** @var \Motor\Mvc\Builder\ModalBuilder $modalConnect */
echo $modalConnect ?? "";
/** @var \Motor\Mvc\Builder\ModalBuilder $modalBuyerDirect */
echo $modalBuyerDirect ?? "";
?>
<section class="m-2 w-auto p-4 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
  <h2 class="my-2 text-base md:text-xl lg:text-2xl xl:text-3xl font-bold text-gray-900 dark:text-white">ModalBuilde Page Test</h2>
  <p class="mb-5 text-base md:text-lg text-gray-500 sm:text-lg dark:text-gray-400">Voici deux des multiples possibilité de génération de modale dynamique et statique.</p>
  <section class="flex flex-col md:flex-row gap-5 justify-center items-center">
    <article class="my-2 h-full max-w-lg p-2 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700">

      <h3 class="mb-2 text-base md:text-lg lg:text-xl xl:text-2xl font-medium text-gray-900 dark:text-white">Modale static</h3>
      <p class="mb-2 text-sm md:text-base text-gray-600 dark:text-gray-300">Dans cette exemple une varible avec le contenue du body de la modale à été définie dans le controlleur ModaleController</p>

      <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">

        <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
          <svg class="h-10 w-10" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 60.671 60.671" xml:space="preserve" fill="#c7c7c7" stroke="#c7c7c7">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <g>
                <g>
                  <ellipse style="fill:#7d7d7d;" cx="30.336" cy="12.097" rx="11.997" ry="12.097"></ellipse>
                  <path style="fill:#7d7d7d;" d="M35.64,30.079H25.031c-7.021,0-12.714,5.739-12.714,12.821v17.771h36.037V42.9 C48.354,35.818,42.661,30.079,35.64,30.079z"></path>
                </g>
              </g>
            </g>
          </svg>
          <div class="text-left rtl:text-right text-nowrap">

            <?= $buttonModalConnect ?? "" ?>

          </div>
        </div>

      </div>
    </article>
    <article class="my-2  h-full max-w-lg p-2 text-center bg-white border border-gray-200 rounded-lg shadow sm:p-4 dark:bg-gray-800 dark:border-gray-700">

      <h3 class="mb-2 text-base md:text-lg lg:text-xl xl:text-2xl font-medium text-gray-900 dark:text-white">Modale static</h3>
      <p class="mb-2 text-sm md:text-base text-gray-600 dark:text-gray-300">Dans cette exemple une varible avec le contenue du body de la modale à été définie dans le controlleur ModaleController</p>

      <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">

        <div class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
          <svg class="h-10 w-10" viewBox="0 0 512 512" id="Layer_1" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <style type="text/css">
                .st0 {
                  fill: #909498;
                }

                .st1 {
                  fill: #4a8112;
                }
              </style>
              <g>
                <path class="st0" d="M253.3,39.5h-118v60.2h118V39.5z M232.8,76.6h-77c-3.9,0-7-3.1-7-7c0-3.9,3.1-7,7-7h77c3.9,0,7,3.1,7,7 C239.8,73.4,236.7,76.6,232.8,76.6z"></path>
                <path class="st0" d="M121.3,39.5h-15.2c-14.2,0-25.8,11.5-25.8,25.8v34.4h41V39.5z"></path>
                <path class="st0" d="M308.3,65.3c0-14.2-11.5-25.8-25.8-25.8h-15.2v60.2h41V65.3z"></path>
                <path class="st0" d="M80.3,446.7c0,14.2,11.5,25.8,25.8,25.8h15.2v-60.2h-41V446.7z"></path>
                <path class="st0" d="M267.3,472.5h15.2c14.2,0,25.8-11.5,25.8-25.8v-34.4h-41V472.5z"></path>
                <path class="st0" d="M135.3,472.5h118v-60.2h-118V472.5z M194.3,428.9c7.4,0,13.5,6,13.5,13.5c0,7.5-6.1,13.5-13.5,13.5 c-7.5,0-13.5-6-13.5-13.5C180.8,435,186.9,428.9,194.3,428.9z"></path>
                <path class="st0" d="M238.3,349.8l-78,41.9l41.2-77.5c-15.6-22.4-24.1-49.3-24.1-76.8c0-35.2,13.5-68.5,38.1-93.7 c12.8-13.1,27.8-23.2,44.1-30.1H80.3v284.7h228v-26.8c-0.2,0-0.3,0-0.4,0C282.9,370.8,259,363.4,238.3,349.8z"></path>
                <path class="st1" d="M311.5,117.3c-1.1,0-2.1,0-3.2,0.1c-64.8,1.7-116.9,54.8-116.9,120.1c0,28.6,10,54.8,26.6,75.5l-23.8,44.7 l45-24.2c19.3,14.6,43.1,23.4,69,24.1c1.1,0,2.2,0.1,3.2,0.1c66.4,0,120.1-53.8,120.1-120.2C431.7,171.1,377.9,117.3,311.5,117.3z M276.3,309.1c-3,0-5.5-2.5-5.5-5.5c0-3,2.5-5.5,5.5-5.5c3,0,5.5,2.5,5.5,5.5C281.8,306.6,279.4,309.1,276.3,309.1z M326.1,309.1 c-3,0-5.5-2.5-5.5-5.5c0-3,2.5-5.5,5.5-5.5c3,0,5.5,2.5,5.5,5.5C331.6,306.6,329.1,309.1,326.1,309.1z M384.8,189.3h-11.6 L363,216.7c0,0,0,0,0,0l-22.8,61c-1,2.7-3.6,4.6-6.6,4.6h-64.8c-2.9,0-5.4-1.7-6.5-4.4l-24.4-61.1c-0.9-2.2-0.6-4.6,0.7-6.5 c1.3-1.9,3.5-3.1,5.8-3.1h107.2l10.2-27.4c1-2.7,3.6-4.6,6.6-4.6h16.4c3.9,0,7,3.1,7,7C391.8,186.1,388.7,189.3,384.8,189.3z"></path>
                <polygon class="st1" points="254.7,221.2 254.7,221.2 266.4,250.5 273.5,268.3 273.5,268.3 273.5,268.3 328.7,268.3 337,246.2 346.3,221.2 254.7,221.2 "></polygon>
              </g>
            </g>
          </svg>
          <div class="text-left rtl:text-right text-nowrap">

            <?= $buttonModalBuyerDirect ?? "" ?>

          </div>
        </div>

      </div>
    </article>
  </section>
</section>