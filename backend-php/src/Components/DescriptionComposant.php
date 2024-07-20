<?php
namespace App\Boutique\Components;

class DescriptionComposant{
    public function __construct()
    {
    }
    public function RenderDescribe($categoryName)
    {
        
        if($categoryName === '1'){
            
            $description = "
                <div class='text-gray-700 dark:text-gray-200 '>
                
                <h2 class='font-bold text-xl md:text-3xl lg:text-4xl text-center text-gray-700 dark:text-gray-200 bg-gray-100 p-2'>
                    Nos <span class='text-red-800'>Cafés</span> d'exception
                </h2>
                <p class='text-sm md:text-xl font-semibold lg:text-2xl text-center text-gray-700 dark:text-gray-200 bg-gray-100 p-2'>         
                    Chez <span class='text-green-600'>Tea'</span><span class='text-red-800'>Coffee</span> notre collection de <span class='text-red-800'>cafés</span> est le fruit d'une sélection rigoureuse. Nous collaborons directement avec des cultivateurs et des coopératives locales pour vous offrir les meilleurs grains de <span class='text-red-800'>café</span>, cultivés dans les régions les plus réputées du globe. 
                </p>
                </div>  
                <img src='https://{$_SERVER['HTTP_HOST']}/assets/images/banière/testBannerCoffee.png' class='w-[15rem] mx-auto md:w-[25rem] lg:w-[30rem] lg:h-[12rem]' alt=''>
            ";

        } else {
    
            $description = "
                <div class='text-gray-700 dark:text-gray-200 '>
                    
                    <h2 class='font-bold text-xl md:text-3xl lg:text-4xl text-center text-gray-700 dark:text-gray-200 bg-gray-100 p-2'>
                    Nos <span class='text-green-600'>Thés</span> très recherchés
                    </h2>
                    <p class='text-sm md:text-xl font-semibold lg:text-2xl text-center text-gray-700 dark:text-gray-200 bg-gray-100 p-2'>         
                    Pour les amateurs de <span class='text-green-600'>thé</span>, <span class='text-green-600'>Tea'</span><span class='text-red-800'>Coffee</span> propose une gamme exclusive de <span class='text-green-600'>thés</span> provenant des jardins les plus prestigieux. Que vous préfériez les <span class='text-green-600'>thés</span> noirs robustes, les <span class='text-green-600'>thés</span> verts délicats ou les <span class='text-green-600'>thés</span> blancs subtils, nous avons ce qu'il vous faut. 
                    </p>
                </div>  
                <img src='https://{$_SERVER['HTTP_HOST']}/assets/images/banière/testBannerTea.png' class='w-[15rem] mx-auto md:w-[25rem] lg:w-[30rem] lg:h-[12rem]' alt=''/>
                ";
        }

    return $description;
    
    }
}