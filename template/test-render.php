<!--   class="relative h-[28rem] w-full"
 -->
<!-- Carousel wrapper w-[20rem] lg:w-[60rem] md:w-[40] -->
<div class="lg:max-w-6xl max-w-xl md:max-w-full mx-auto">
  <div class="md:max-w-[85rem]">
    <ul class="flex whitespace-nowrap flex flex-column overflow-hidden gap-6">
      <?php foreach ($products as $item): ?>
      <!--         ml-14 md:ml-14 
 -->
      <div
        class="bg-gray-100 w-[55rem] rounded-2xl p-6 cursor-pointer hover:-translate-y-2 transition-all inline-block relative"
      >
        <!--           
 -->
        <div
          class="bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4"
        >
          <!--            
 -->
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
          class="w-2/3 lg:w-[12rem] h-[220px] overflow-hidden mx-auto aspect-w-16 aspect-h-8"
        >
          <!--             
 -->
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
            <?= $item->price ?>€<strike class="text-gray-400 ml-2 font-medium"
              ><?= $item->price ?>€</strike
            >
          </h4>
          <button
            type="button"
            class="mx-auto w-content flex items-center justify-center gap-3 mt-6 px-4 py-2.5 bg-transparent hover:bg-gray-200 text-base text-[#333] border-2 font-semibold border-[#333] rounded-xl"
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
</div>
