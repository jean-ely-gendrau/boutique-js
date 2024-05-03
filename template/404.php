<section class="w-auto flex flex-col lg:flex-row items-center justify-center space-y-16 lg:space-y-0 space-x-8 2xl:space-x-0 m-2 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
  <div class="w-full flex flex-col md:flex-row items-center justify-between lg:px-2 xl:px-0 text-center">
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center lg:px-2 xl:px-0 text-center">
      <p class="text-7xl md:text-8xl lg:text-9xl font-bold tracking-wider dark:text-gray-300 text-gray-900">Ooops</p>
      <p class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-wider dark:text-gray-300 mt-2 text-gray-700">404</p>
      <p class="text-lg md:text-xl lg:text-2xl text-gray-600 my-12 dark:text-gray-100">Désolé, la page que vous recherchez est introuvable.</p>
      <a href="http://<?= $servername ?>" class="flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-gray-100 dark:text-gray-200 px-4 py-2 rounded transition duration-150" title="Aller à la page Accueil de TeaCoffee">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path>
        </svg>
        <span>Retourner à TeaCoffee Accueil</span>
      </a>
    </div>
    <div class="w-1/2 lg:h-full flex lg:items-end justify-center p-4">
      <svg width="696" height="578" viewBox="0 0 696 578" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M347.935 537.053C539.904 537.053 695.526 529.186 695.526 519.483C695.526 509.779 539.904 501.912 347.935 501.912C155.966 501.912 0.344116 509.779 0.344116 519.483C0.344116 529.186 155.966 537.053 347.935 537.053Z" fill="#3F3D56" fill-opacity="0.25" />
        <path d="M180.813 560.076C255.932 560.076 316.827 556.998 316.827 553.201C316.827 549.404 255.932 546.326 180.813 546.326C105.695 546.326 44.7996 549.404 44.7996 553.201C44.7996 556.998 105.695 560.076 180.813 560.076Z" fill="#3F3D56" fill-opacity="0.25" />
        <g style="mix-blend-mode:color-burn" filter="url(#filter0_i_0_1)">
          <rect x="100" width="519" height="578" fill="url(#pattern0_0_1)" />
        </g>
        <defs>
          <filter id="filter0_i_0_1" x="100" y="0" width="519" height="582" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
            <feFlood flood-opacity="0" result="BackgroundImageFix" />
            <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
            <feOffset dy="0" />
            <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1" />
            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
            <feBlend mode="normal" in2="shape" result="effect1_innerShadow_0_1" />
          </filter>
          <pattern id="pattern0_0_1" patternContentUnits="objectBoundingBox" width="1" height="1">
            <use xlink:href="#image0_0_1" transform="matrix(0.000271895 0 0 0.000244141 -0.0568401 0)" />
          </pattern>
          <image id="image0_0_1" width="4096" height="4096" xlink:href="http://<?= $serverName?>/assets/images/404coffee.png" />
        </defs>
      </svg>
    </div>
  </div>
</section>