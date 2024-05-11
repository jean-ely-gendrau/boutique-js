<div id="menu" class="relative flex justify-center">
  <ul
    id="{$id}"
    class="block list-none p-0 whitespace-nowrap overflow-hidden max-w-6xl px-[20px]"
  >
  <?php foreach ($products as $productItem): ?>
    <div
      class="bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-xl shadow-[3px_3px_9px_0px_rgba(0,0,0,0.6)]"
    >
    <!--  -->
      <div
        id="<?= $productItem->id ?>"
        class="favorites bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4"
      >
        <svg
          class="fill-gray-800 inline-block"
          width="22px"
          viewBox="0 0 192 192"
          xmlns="http://www.w3.org/2000/svg"
          xml:space="preserve"
          fill="none"
        >
          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
          <g
            id="SVGRepo_tracerCarrier"
            stroke-linecap="round"
            stroke-linejoin="round"
          ></g>
          <g id="SVGRepo_iconCarrier">
            <path
              d="M60.732 29.7C41.107 29.7 22 39.7 22 67.41c0 27.29 45.274 67.29 74 94.89 28.744-27.6 74-67.6 74-94.89 0-27.71-19.092-37.71-38.695-37.71C116 29.7 104.325 41.575 96 54.066 87.638 41.516 76 29.7 60.732 29.7z"
              style="
                clip-rule: evenodd;
                display: inline;
                fill: none;
                stroke: rgb(235, 55, 55);
                stroke-width: 12;
                stroke-linecap: round;
                stroke-linejoin: round;
                stroke-miterlimit: 2;
                stroke-dasharray: none;
                stroke-opacity: 1;
              "
            ></path>
          </g>
        </svg>
      </div>
      <img
        id="<?= $productItem->id ?>"
        src="/assets/images/<?= $productItem->url_image ?>"
        alt="<?= $productItem->name ?>"
        class="w-32 h-28 mx-auto mt-12 article-image"
      />
      <p id="<?= $productItem->id ?>" class="article-name mt-3 font-bold">
        <?= $productItem->name ?>
      </p>
      <div class="flex justify-center">
        <p class="mt-3 font-bold mr-2"><?= $productItem->price ?>€</p>
        <p class="mt-3 font-medium text-gray-300"><?= $productItem->price ?>€</p>
      </div>
      <div>
        <a href="addtobasket/<?= $productItem->id ?>">
          <button
            type="button"
            class="w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full"
          >
            Add to cart
          </button>
        </a>
      </div>
    </div>
    <?php endforeach; ?>
  </ul>
  <div id="nav" class="absolute top-0 w-[1152px]">
    <button
      data-js="handelScrollX,click"
      data-direction-scroll="l"
      data-scroll-x="{$idElement}"
      id="font"
      class="absolute -left-12 inline-block text-black my-40 cursor-pointer rounded-full text-6xl font-semibold w-12 h-12 text-center p-0 bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-600/30 focus:outline-none"
    >
      <
    </button>
    <button
      data-js="handelScrollX,click"
      data-direction-scroll="r"
      data-scroll-x="{$idElement}"
      id="font"
      class="absolute -right-12 inline-block text-black my-40 cursor-pointer rounded-full text-6xl font-semibold w-12 h-12 text-center p-0 bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-600/30 focus:outline-none"
    >
      >
    </button>
  </div>
</div>
<!-- *************************************************************************************** -->
<div class="font-[sans-serif]">
  <div class="p-4 mx-auto lg:max-w-6xl max-w-xl md:max-w-full lg:relative lg:flex lg:justify-center">

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:flex lg:whitespace-nowrap lg:overflow-hidden gap-6">
      <!-- -->
      <?php foreach ($products as $item): ?>
      <div
        class="bg-gray-100 w-[55rem] rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all lg:inline-block lg:relative"
      >
      <!--  -->
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
              d="M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 0 0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z"
              data-original="#000000"
            ></path>
          </svg>
        </div>
        <div
          class="w-2/3 h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8"
        >
          <img
            src="https://readymadeui.com/images/coffee1.webp"
            alt="Product 1"
            class="h-full w-full object-contain"
          />
        </div>
        <div class="text-center mt-4">
          <h3 class="text-lg font-extrabold text-gray-800">
            <?= $item->name ?>
          </h3>
          <h4 class="text-2xl text-gray-800 font-bold mt-4">
            $10 <strike class="text-gray-400 ml-2 font-medium">$15</strike>
          </h4>
          <button
            type="button"
            class="w-full flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="20px"
              height="20px"
              viewBox="0 0 512 512"
            >
              <path
                d="M164.96 300.004h.024c.02 0 .04-.004.059-.004H437a15.003 15.003 0 0 0 14.422-10.879l60-210a15.003 15.003 0 0 0-2.445-13.152A15.006 15.006 0 0 0 497 60H130.367l-10.722-48.254A15.003 15.003 0 0 0 105 0H15C6.715 0 0 6.715 0 15s6.715 15 15 15h77.969c1.898 8.55 51.312 230.918 54.156 243.71C131.184 280.64 120 296.536 120 315c0 24.812 20.188 45 45 45h272c8.285 0 15-6.715 15-15s-6.715-15-15-15H165c-8.27 0-15-6.73-15-15 0-8.258 6.707-14.977 14.96-14.996zM477.114 90l-51.43 180H177.032l-40-180zM150 405c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm167 15c0 24.813 20.188 45 45 45s45-20.188 45-45-20.188-45-45-45-45 20.188-45 45zm45-15c8.27 0 15 6.73 15 15s-6.73 15-15 15-15-6.73-15-15 6.73-15 15-15zm0 0"
                data-original="#000000"
              ></path>
            </svg>
            Add to cart
          </button>
        </div>
      </div>
      <?php endforeach; ?>
    </ul>
      <div id="nav" class="absolute top-0 w-[1152px]">
    <button
      data-js="handelScrollX,click"
      data-direction-scroll="l"
      data-scroll-x="{$idElement}"
      id="font"
      class="absolute -left-12 inline-block text-black my-40 cursor-pointer rounded-full text-6xl font-semibold w-12 h-12 text-center p-0 bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-600/30 focus:outline-none"
    >
      <
    </button>
    <button
      data-js="handelScrollX,click"
      data-direction-scroll="r"
      data-scroll-x="{$idElement}"
      id="font"
      class="absolute -right-12 inline-block text-black my-40 cursor-pointer rounded-full text-6xl font-semibold w-12 h-12 text-center p-0 bg-white/30 dark:bg-gray-800/30 hover:bg-gray-400/30 active:bg-gray-600/30 focus:outline-none"
    >
      >
    </button>
  </div>
</div>
  </div>
</div>
