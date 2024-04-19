<?php
namespace App\Boutique\Components;

use App\Boutique\Models\TestProducts;
use App\Boutique\Manager\BddManager;

class HorizontalSelector
{
    protected $serverPath;
    // private $bddManager;
    // BddManager $bddManager
    public function __construct()
    {
        global $serverName;
        $this->serverPath = $serverName;
        // $this->bddManager = $bddManager;
    }

    public function generateProductList($products)
    {
        // $testProducts = new TestProducts($this->bddManager);
        // $products = $testProducts->AllProduct();
        //                        <img src='/assets/images/{$productItem['images']['main']}' alt='{$productItem['name']}' class='w-32 h-28 mx-auto mt-12' />

        $slider = "
        <div id='menu' class='relative flex justify-center'>
            <ul class='block list-none p-0 whitespace-nowrap overflow-hidden max-w-6xl px-[20px]'>";
        foreach ($products as $productItem):
            $slider .= "  <div class='bg-gray-100 w-60 h-80 inline-block relative text-center m-2.5 rounded-xl'>
                        <div class='bg-gray-200 w-10 h-10 flex items-center justify-center rounded-full cursor-pointer absolute top-4 right-4'>
                            <svg xmlns='http://www.w3.org/2000/svg' width='18px' class='fill-gray-800 inline-block' viewBox='0 0 64 64'>
                                <path d='M45.5 4A18.53 18.53 0 0 0 32 9.86 18.5 18.5 0 0 0 0 22.5C0 40.92 29.71 59 31 59.71a2 2 0 0 0 2.06 0C34.29 59 64 40.92 64 22.5A18.52 18.52 0 0 0 45.5 4ZM32 55.64C26.83 52.34 4 36.92 4 22.5a14.5 14.5 div0 1 26.36-8.33 2 2 0 0 0 3.27 0A14.5 14.5 0 0 1 60 22.5c0 14.41-22.83 29.83-28 33.14Z' data-original='#000000'></path>
                            </svg>
                        </div>
                        <!-- emplacement image products -->
                        <p class='mt-3 font-bold'>{$productItem->name}</p>
                        <div class='flex justify-center'>
                            <p class='mt-3 font-bold mr-2'>{$productItem->price}€</p>
                            <p class='mt-3 font-medium text-gray-300'>{$productItem->price}€</p>
                        </div>
                        <div>
                            <button type='button' class='w-48 mt-4 px-4 py-3 bg-[#333] hover:bg-[#222] text-white rounded-full'>
                                Add to cart
                            </button>
                        </div>
                    </div>";
        endforeach;
        $slider .= "</ul> 
            <div id='nav' class='absolute top-0 w-[1152px]'> 
                <div id='prev' class='absolute left-0 inline-block p-1 bg-gray-200 text-white my-40 cursor-pointer rounded-full'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>
                        <polygon points='15.293 3.293 6.586 12 15.293 20.707 16.707 19.293 9.414 12 16.707 4.707 15.293 3.293'/>
                    </svg>
                </div>
                <div id='next' class='absolute right-0 inline-block p-1 bg-gray-200 text-white my-40 cursor-pointer rounded-full'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'>
                        <polygon points='7.293 4.707 14.586 12 7.293 19.293 8.707 20.707 17.414 12 8.707 3.293 7.293 4.707'/>
                    </svg>
                </div>
            </div>
        </div>";
        return $slider;
    }
}

?>
