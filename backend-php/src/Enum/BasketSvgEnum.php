<?php

namespace App\Boutique\Enum;

enum BasketSvgEnum: string
{
  case En_Attente = '<svg class="w-6 h-6 md:h-10 md:w-10 stroke-black dark:stroke-white" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg">
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
  </svg>';
  case Expedier = '<svg viewBox="0 0 24 24" class="w-6 h-6 md:h-10 md:w-10 stroke-black dark:stroke-white" fill="none" xmlns="https://www.w3.org/2000/svg">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
      <path d="M11.0287 2.53961C11.6327 2.20402 12.3672 2.20402 12.9713 2.5396L20.4856 6.71425C20.8031 6.89062 21 7.22524 21 7.5884V15.8232C21 16.5495 20.6062 17.2188 19.9713 17.5715L12.9713 21.4604C12.3672 21.796 11.6327 21.796 11.0287 21.4604L4.02871 17.5715C3.39378 17.2188 3 16.5495 3 15.8232V7.5884C3 7.22524 3.19689 6.89062 3.51436 6.71425L11.0287 2.53961Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      <path d="M3 7L12 12M12 12L21 7M12 12V21.5" stroke="#000000" stroke-width="2" stroke-linejoin="round"></path>
      <path d="M7.5 9.5L16.5 4.5" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      <path d="M6 12.3281L9 14" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
    </g>
  </svg>';
  case Livrer = '<svg class="w-6 h-6 md:h-10 md:w-10 stroke-black dark:stroke-white" version="1.1" id="_x32_" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
      <style type="text/css">
        .st0 {
          fill: #000000;
        }
      </style>
      <g>
        <path class="st0" d="M447.77,33.653c-36.385-5.566-70.629,15.824-82.588,49.228h-44.038v37.899h40.902 c5.212,31.372,29.694,57.355,62.855,62.436c41.278,6.316,79.882-22.042,86.222-63.341C517.428,78.575,489.07,39.969,447.77,33.653z "></path>
        <path class="st0" d="M162.615,338.222c0-6.88-5.577-12.468-12.468-12.468H96.16c-6.891,0-12.467,5.588-12.467,12.468 c0,6.868,5.576,12.467,12.467,12.467h53.988C157.038,350.689,162.615,345.091,162.615,338.222z"></path>
        <path class="st0" d="M392.999,237.965L284.273,340.452l-37.966,9.398v-86.619H0v215.996h246.307v-59.454l35.547-5.732 c16.95-2.418,29.396-6.692,44.336-15.018l46.302-24.228v104.432h132.435V270.828C504.927,202.618,428.016,202.43,392.999,237.965z M215.996,448.913H30.313v-155.37h185.683v63.805l-36.419,9.01c-15.968,4.395-25.708,20.518-22.174,36.696l0.298,1.247 c3.478,15.912,18.651,26.436,34.785,24.14l23.51-3.788V448.913z"></path>
      </g>
    </g>
  </svg>';
  case Echec = '<svg viewBox="0 0 1024 1024" class="icon w-6 h-6 md:h-10 md:w-10 fill-red-600 dark:fill-red-300" version="1.1" xmlns="https://www.w3.org/2000/svg" fill="#000000">
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
    <g id="SVGRepo_iconCarrier">
      <path d="M512 128C300.8 128 128 300.8 128 512s172.8 384 384 384 384-172.8 384-384S723.2 128 512 128z m0 85.333333c66.133333 0 128 23.466667 179.2 59.733334L273.066667 691.2C236.8 640 213.333333 578.133333 213.333333 512c0-164.266667 134.4-298.666667 298.666667-298.666667z m0 597.333334c-66.133333 0-128-23.466667-179.2-59.733334l418.133333-418.133333C787.2 384 810.666667 445.866667 810.666667 512c0 164.266667-134.4 298.666667-298.666667 298.666667z"></path>
    </g>
  </svg>';

  public static function fromName(string $name)
  {

    return constant("self::$name");
  }
}
