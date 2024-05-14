<?php
namespace App\Boutique\Components;

class Carousel
{
    public function __construct()
    {
    }

    public function RenderCarousel($itemElement)
    {
        $carousel = '<div id="carousel-exemple" class="relative md:max-w-[85rem] mx-auto" data-carousel="slide">
                        <!-- Carousel wrapper -->
                     <div class="relative h-56 overflow-hidden rounded-lg md:h-[34rem] w-11/12 mx-auto">';

        if ($itemElement['element']) {
            foreach ($itemElement['element'] as $index => $element) {
                $carousel .= "<div id='carousel-indicator-" . $index . "' class='hidden duration-900 ease-in-out' data-carousel-item>";
                $carousel .= file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . $element);
                $carousel .= '</div>';
            }
        }

        if ($itemElement['image']) {
            foreach ($itemElement['image'] as $index => $image) {
                $carousel .=
                    "<div id='carousel-indicator-" .
                    $index .
                    "' class='hidden duration-900 ease-in-out' data-carousel-item>
                        <img
                        src='{$image}'
                        class='object-cover rounded-3xl absolute block w-full h-full max-h-[32rem] -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2'
                        alt='...'
                        />
                     </div>";
            }
        }

        $carousel .= '</div>';
        $carousel .= "<div
        class='absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse'
        >";

        for ($i = 0; $i < count($itemElement, COUNT_RECURSIVE) - 2; $i++) {
            $carousel .= "<button
                                type='button'
                                class='w-3 h-3 rounded-full'
                                aria-current='true'
                                aria-label='Slide {$i}'
                                data-carousel-slide-to='{$i}'
                            ></button>";
        }

        $carousel .= '</div>';
        $carousel .= '<!-- Slider controls  group-focus:ring-4 group-focus:ring-gray-300 dark:group-focus:ring-gray-800/70 group-focus:outline-none -->
                      <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full cursor-pointer" data-carousel-prev>
                        <span
                          class="inline-flex items-center justify-center w-16 h-16 rounded-full text-gray-700 dark:text-gray-200 hover:bg-gray-400/30 active:bg-gray-800/30 focus:outline-none focus:ring"
                        >
                          <svg
                            class="w-8 h-8 text-black dark:text-gray-200 rtl:rotate-180"
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
                      <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full cursor-pointer group focus:outline-none" data-carousel-next>
                        <span
                          class="inline-flex items-center justify-center w-16 h-16 rounded-full text-gray-700 dark:text-gray-200 hover:bg-gray-400/30 active:bg-gray-800/30 focus:outline-none focus:ring"
                        >
                          <svg
                            class="w-8 h-8 text-black dark:text-gray-200 rtl:rotate-180"
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
                    </div>';

        return $carousel;
    }
}
